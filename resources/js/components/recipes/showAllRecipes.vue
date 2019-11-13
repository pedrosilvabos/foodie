<template>
<div id="#apps">
    <input type="text" v-model="search" placeholder="Find">
    <div class="content">
        <div class="container">
            <div class="row" id="#app">
              
                <div class="col">
                    <div v-for="(precipe, index) in filteredRecipes" :key="(precipe, index)"> 
                        {{ precipe.recipes_name }} 
                        <input type="button" class="fa fa-plus" aria-hidden="true" v-on:click="ShowRecipe(precipe,recipeDescription)" value="add">
                    </div>
                </div>
                <div class="col">
                    all the ingredients the use has
                    <div v-for="userIngredient in pantry" :key="userIngredient.id">
                        {{ userIngredient.id }} - {{ userIngredient.name }}
                    </div>
                </div>
                 <div class="col">     
                    needed ingredients you need to buy
                        <div v-for="(userIngredient) in cart" :key="userIngredient.id">
                         
                            {{userIngredient}}
                    </div>
                </div>
                <div class="col">     
                    needed ingredients you need to make recipe
                     <div v-for="(neededIngredient) in recipeDescription" :key="neededIngredient.id">  
                        {{ neededIngredient.id }} - {{neededIngredient.name}}
                    </div>
                </div>
                 
                <div class="col">     
                    all the ingredients in the library
                    <div v-for="ingredient in ingredients" :key="ingredient.id">
                        {{ ingredient.name }}
                    </div>
                </div>
                </div>
               
            </div>
        </div>
    </div>

</template>

<script>
    export default {
         props: ["user"],
        data(){
            return {
                recipes : [],
                recipeDescription: [],
                search:'',
                ingredients: [],
                pantry: [],
                userIngredients: [],
                cart:[],
               
            }

        },
        created() {
      
        this.userId = this.user.id;
        axios
        .get("../api/pantry/" + this.userId) // add user token
        .then(response => (this.pantry = response.data.ingredients));
        axios
        .get("../api/ingredients") // add user token
        .then(response => (this.ingredients = response.data));
       
        if(this.userId == 0){
            this.pantry = [];
        }
            axios.get('../api/recipes') // add user token
            .then(response => this.recipes = response.data)

        },
       
        computed: {
            filteredRecipes: function(){

         
                 if(this.recipeDescription.length != 0){
                     console.log('inside if')
                     var i = 0;
                     var j = 0;
                     for (i;i<this.recipeDescription.length;i++){
                         for(j;j<this.pantry.length;j++){
                             if(this.recipeDescription[i].name == this.pantry[j].name){
                                 console.log('match!');
                             }else{
                                 if(this.cart.includes(this.recipeDescription[i].name) != true)
                                  this.cart.push(this.recipeDescription[i].name);
                             }
                         }
                     }
                 }
                 
                return this.recipes.filter((recipe) => {
                    return recipe.recipes_name.toLowerCase().match(this.search.toLowerCase());
                });
            }
        },
        methods: {
            ShowRecipe: function(recipe,recipeDescription){
            axios.get('../api/recipes/' + recipe.id) // add user token
            .then(response => this.recipeDescription = response.data.ingredients),
            console.log(recipeDescription)
            },
            RemoverecipeFromPantry: function(index){
                this.pantry.splice(index,1);
            },
            ClearCart: function(){
                this.recipe = {}
            },
            GetImagePath(index){         
                return this.recipes[index].recipe_icon;
            },
           
        },
        
    }
</script>

<style>


</style>