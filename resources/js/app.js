import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import FormComponent from './components/FormComponent.vue';
app.component('form-component', FormComponent);

app.mount('#app');
