# grunt-comment-media-queries

> Removes media queries to generate stylesheets for old IE. The content of those media queries is left alone. This is crude, and is only useful if CSS is written mobile-first.

## Getting Started
This plugin requires Grunt `~0.4.1`

If you haven't used [Grunt](http://gruntjs.com/) before, be sure to check out the [Getting Started](http://gruntjs.com/getting-started) guide, as it explains how to create a [Gruntfile](http://gruntjs.com/sample-gruntfile) as well as install and use Grunt plugins. Once you're familiar with that process, you may install this plugin with this command:

```shell
npm install grunt-comment-media-queries --save-dev
```

One the plugin has been installed, it may be enabled inside your Gruntfile with this line of JavaScript:

```js
grunt.loadNpmTasks('comment-media-queries');
```

## The "comment-media-queries" task

### Overview
In your project's Gruntfile, add a section named `comment-media-queries` to the data object passed into `grunt.initConfig()`.

```js
grunt.initConfig({
  "comment-media-queries": {
    options: {
      // Task-specific options go here.
    },
    your_target: {
      // Target-specific file lists and/or options go here.
    },
  },
})
```
