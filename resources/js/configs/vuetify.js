import { createVuetify } from 'vuetify';
import * as directives from 'vuetify/directives'
import theme from './theme';

const vuetify = createVuetify({
  directives,
  theme
})

export default vuetify;
