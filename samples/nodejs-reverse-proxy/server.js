import express from "express";
import request from 'request'
import bodyParser from 'body-parser';
import 'dotenv/config';

const app = express();
const myLimit = typeof (process.argv[2]) != 'undefined' ? process.argv[2] : '100kb';
console.log('Using limit: ', myLimit);
app.use(bodyParser.json({limit: myLimit}));

app.all('/proxy', function (req, res, next) {
    // Some resources do not give the correct header,
    // because of which the script outside the tag will not load as a consequence of CORS
    res.header("Access-Control-Allow-Origin", req?.origin ?? "*");
    res.header("Access-Control-Allow-Methods", "GET, PUT, PATCH, POST, DELETE");

    const resourceUrl = req.query?.url;

    if (!resourceUrl) {
        res.send(500, {error: 'There is no URL specified'});
    }

    const resourceUrlDecoded = decodeURIComponent(resourceUrl);

    if (req.method === 'OPTIONS') {
        // CORS Preflight
        res.send();
    } else {
        if (!resourceUrlDecoded) {
            res.send(500, {error: 'There is no Target-Endpoint header in the request'});
            return;
        }

        let additionalHeaders = {};
        if (req.header('Authorizaton')) {
            additionalHeaders['Authorization'] = req.header('Authorization');
        }

        request(resourceUrlDecoded,
            {method: req.method, ...additionalHeaders},
            function (error, response, body) {

                if (error) {
                    console.error('error: ' + response.statusCode)
                }
            }).pipe(res);
    }
});

app.set('port', process.env.PORT || 3000);

app.listen(app.get('port'), function () {
    console.log('Proxy server listening on port ' + app.get('port'));
});