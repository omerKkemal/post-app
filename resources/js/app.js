import './bootstrap';
import '../css/app.css';
import '../css/layout-app.css';
import '../css/nav.css';
import '../css/view.css';
import '../css/postView.css';
import '../css/guest.css';
import '../css/auth-login.css';
import '../css/create.css';

import './layout-app.js';
import './nav.js';
import './view.js';
import './postview.js';
import './postview-extra.js';
import './guest.js';
import './auth-login.js';
import './create.js';
import './welcome.js';
import './dashboard.js';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

console.log('App initialized successfully');
