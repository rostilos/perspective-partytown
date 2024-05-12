<h2>Proxying Requests</h2>

Often third-party scripts are added to the page by appending a script tag.

However, because Partytown requests the scripts within a web worker using fetch(), then the script’s response requires the correct CORS headers.

Many third-party scripts already provide the correct CORS headers, but not all do. For services that do not add the correct headers, then a reverse proxy to another domain must be used in order to provide the CORS headers.

ref. <a href="https://partytown.builder.io/proxying-requests">From Docs</a>

<h3>Example of a self-hosted reverse proxy on nginx to proxy such requests and add headers necessary for analytics ( or other functionality ) to work</h3>
<p><strong>Important : The solution is designed to be used with warden, but the nginx.conf file will work on native nginx as well </strong></p>


<h2>Installation</h2>
<ul>
  <li>
    Add the .warden folder from the repository ( samples/warden-nginx-reverse-proxy/.warden ) to the root of the project ( at the same level where the .env file for warden is located
  </li>
  <li>Run warden env up</li>
  <li>Locally, you will now be able to access the server at the url https://localhost:8080</li>
</ul>

<p>Configuration via M2 admin panel</p>
<ul>
  <li>Stores -> Configuration -> Perspective -> Partytown </li>
  <li>In the Proxying Requests tab, enable proxying, specify the domains you want to proxy, and also specify the url for the proxy</li>
</ul>
<p>
  Configuration Example:
</p>


