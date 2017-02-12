var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .enableSassLoader()
    .enableBuildNotifications()
    .autoProvideVariables({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
    })

    .addEntry('js/app', './assets/js/app.js')
    .addEntry('js/home', './assets/js/home.js')
    .addEntry('js/manifesto', './assets/js/manifesto.js')
    .addStyleEntry('css/app', './assets/scss/style.scss')
;

module.exports = Encore.getWebpackConfig();
