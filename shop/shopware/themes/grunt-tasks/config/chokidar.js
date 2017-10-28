module.exports = {
    less: {
        files: [
            '../engine/Shopware/Plugins/**/*.less',
            '../engine/Shopware/Plugins/**/*.css',
            '../themes/Frontend/**/*.less',
            '../themes/Frontend/**/*.css',
            '../custom/plugins/**/*.less',
            '../custom/plugins/**/*.css'
        ],
        tasks: ['less:development'],
        options: {
            spawn: false,
            livereload: true
        }
    },
    js: {
        files: [
            '../themes/Frontend/**/_public/src/js/*.js',
            '../engine/Shopware/Plugins/**/frontend/**/src/js/**/*.js',
            '../custom/plugins/**/frontend/**/src/js/**/*.js'
        ],
        tasks: ['uglify:development'],
        options: {
            spawn: false,
            livereload: true
        }
    }
};
