'use strict';

require('../sass/reports.scss')
require('./modules/expand')

import CategorySwitcher from "./modules/category-switcher";

const categorySwitcher = new CategorySwitcher();

categorySwitcher.init();
