

import SweetAlertIcons from 'vue-sweetalert-icons';
require('./bootstrap');

window.Vue = require('vue');

Vue.use(SweetAlertIcons);
Vue.component('pantrylist', require('./components/pantry/pantry.vue').default);
Vue.component('ingredientlist', require('./components/ingredients/IngredientList.vue').default);
Vue.component('showallrecipes', require('./components/recipes/showAllRecipes.vue').default);
Vue.component('createrecipe', require('./components/recipes/createRecipe.vue').default);
Vue.component('createingredient', require('./components/ingredients/createIngredient.vue').default);

const app = new Vue({
    el: '#app',
});

