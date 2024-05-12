<h1>Module for integrating  BuilderIO/partytown library functionality into Magento 2 project</h1>
<p>With this module you will be able to use the <a href="https://partytown.builder.io/">BuilderIO/partytown</a> in your Magento 2 project, which will allow you to optimize the frontend part of your project by separating the execution of analytics scripts into a separate thread of the webworker.</p>

<p>A small example of how this can affect TBT ( and not only ) metrics when validated with Lighthouse Api 

Traditional connection / with Partytown module:
</p>

![diff](https://github.com/rostilos/perspective-partytown/assets/85498741/cae5b261-8992-4ef9-9761-61a149b1c5fb)


<h2>Requirements: </h2>

<ol>
  <li>PHP 8.1 or higher</li>
  <li>Magento 2.4.4 or higher</li>
  <li>Node.js v16 or higher</li>
  <li>configured https for the domain ( for correct work of service wokers )</li>
  <li>Optional : configured reverse proxy for correct loading of some scripts ( see below )</li>
</ol>


<h2>Installing the module</h2>

<ol>
  <li>composer config repositories.perspective-magento2-partytown git git@github.com:rostilos/perspective-partytown.git</li>
  <li>composer require perspective/magento2-partytown dev-master</li>
  <li>php bin/magento setup:upgrade</li>
  <li>bin/magento setup:di:compile</li>  
  <li>php bin/magento setup:static-content:deploy</li>
  <li>Clear all Cache</li>
</ol>

<h2>Updating partytown npm packages </h2>
<p>The library files provided by the npm package @builder.io/partytown are already added to the module files, but in case you want to update them, it is recommended to do the following :</p>

<ol>
  <li>cd _magento-root_/vendor/perspective/magento2-partytown</li>
  <li>npm install ( node v16+ required )</li>
  <li>npm run partytown</li>
</ol>

<p>Note that if you update the composer package, or reinstall it, you will revert to the existing version in the repository. This is planned to be fixed in future updates</p>


<h2>Configurations</h2>
<p>In order for scripts to be loaded and executed in a separate thread of the webworker - you need to set the appropriate type ( text/partytown ) when connecting them. Using the example of GMT : </p>

````
<!-- Google Tag Manager -->
<script type="text/partytown">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-XXXXXXXX');</script>
<!-- End Google Tag Manager -->
````


<p>Configuration of the module is managed through the admin panel, where you can select the list of available analytics services that will be allocated for execution in the webworker, as well as specify other configurations that affect the functionality of the library
</p>

![5e55bf15-1b51-4003-b123-83f7ec7f4cfe](https://github.com/rostilos/perspective-partytown/assets/85498741/c18cc971-2ff3-4457-a6d2-7830d09cb57d)

<h2>For correct work it is recommended to specify url to reverse proxy</h2>

<a href="https://github.com/rostilos/perspective-partytown/blob/2.0.0-alpha/docs/reverse-proxy.md">Example of a self-hosted implementation using nodejs </a>

<a href="https://github.com/rostilos/perspective-partytown/blob/master/docs/reverse-proxy-nginx.md">Example of a self-hosted implementation using warden and custom container for revense-proxy ( nginx based ) </a>

<p>The <a href="https://partytown.builder.io/proxying-requests">official documentation</a> provides a list of possible reverse-proxy implementations.</p>
<p>In my practice I have tried the approach using Cloudflare Workers</p>

<p>Cloudflare Workers can be used as a reverse proxy ( more for testing purposes or for sites with low traffic due to Cloudflare limitations ) proxied with Cloudflare </p>

![cb2ad081-f2de-4200-8421-938213900f29](https://github.com/rostilos/perspective-partytown/assets/85498741/b661604c-392e-4e0e-a98b-54fb776c7e92)
