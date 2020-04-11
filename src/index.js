import jQuery from 'jquery';
import './styles/main.css';

import Router from './scripts/utilities/Router';
import common from './scripts/routes/common';
import home from './scripts/routes/home';

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
