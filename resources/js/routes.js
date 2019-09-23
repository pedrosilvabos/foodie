import Home from './components/login/login.vue';
import IngredientsList from './components/ingredients/IngredientList.vue';
import Example from './components/example.vue';
w
export const routes = [
    { path: '/login', component: Home, name: 'Home' },
    { path: '/ingredients', component: IngredientsList, name: 'Ingredients' },
    { path: '/example', component: Example, name: 'Example' }
];
