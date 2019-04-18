import jQuery from 'jquery';
import './style.css';

import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';

import './images/logo.svg'

/**
 * Populate Router instance with DOM routes
 * @type {Router} routes - An instance of our router
 */
const routes = new Router({
  /** All pages */
  common,
  /** Home page */
  home
});

/** Load Events */
jQuery(document).ready(() => routes.loadEvents());
