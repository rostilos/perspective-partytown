<h2>Proxying Requests</h2>

Often third-party scripts are added to the page by appending a script tag.

However, because Partytown requests the scripts within a web worker using fetch(), then the script’s response requires the correct CORS headers.

Many third-party scripts already provide the correct CORS headers, but not all do. For services that do not add the correct headers, then a reverse proxy to another domain must be used in order to provide the CORS headers.

ref. <a href="https://partytown.builder.io/proxying-requests">From Docs</a>

<h3>Example of a self-hosted reverse proxy on nginx to proxy such requests and add headers necessary for analytics ( or other functionality ) to work</h3>
<p><strong>Important : this should only be used for testing purposes and a tool for local testing, not a production solution.</strong></p>

<p>Starting nodejs reverse-proxy server</p>
<ul>
  <li>cd samples/nodejs-reverse-proxy</li>
  <li>npm install ( node v16+ )</li>
  <li>node server.js</li>
  <li>Next, the nodejs server will start, the default url is http://127.0.0.1:3000.</li>
</ul>

<p>Configuration via M2 admin panel</p>
<ul>
  <li>Stores -> Configuration -> Perspective -> Partytown </li>
  <li>In the Proxying Requests tab, enable proxying, specify the domains you want to proxy, and also specify the url for the proxy</li>
</ul>
<p>
  Configuration Example:
</p>

![2024-05-11_03-20](https://github.com/rostilos/perspective-partytown/assets/85498741/377df98b-e626-4f0f-ad53-5c3dc047ad26)
