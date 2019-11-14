<template>
<div id="#apps">
    <input type="text" v-model="search" placeholder="Find">
    <div class="content">
        <div class="container">
            <div class="row" id="#app"> 
                <div class="col-3">
                    <div v-for="(precipe, index) in filteredRecipes" :key="(precipe, index)"> 
                        {{ precipe.recipes_name }} 
                        <input type="button" class="fa fa-plus" aria-hidden="true" v-on:click="ShowRecipe(precipe,recipeDescription,action='add')" value="add">
                        <input type="button" class="fa fa-plus" aria-hidden="true" v-on:click="ShowRecipe(precipe,recipeDescription,action='show')" value="details">
                        <input type="button" class="fa fa-plus" aria-hidden="true" v-on:click="ShowRecipe(precipe,recipeDescription,action='remove')" value="remove">
                    </div>
                </div>
                <div class="col-3">
                    all the ingredients the use has
                    <div v-for="userIngredient in pantry" :key="userIngredient.id">
                        {{ userIngredient.quantity_gr }} - {{ userIngredient.name }}
                    </div>
                </div>
                <div class="col-2">     
                    needed ingredients you need to buy
                    <div v-for="(userIngredient) in cart" :key="userIngredient.id">
                        {{userIngredient.quantity_gr}}  {{userIngredient.name}}
                    </div>
                </div>
                <div class="col-2">     
                    needed ingredients to make recipe
                    <div v-for="(neededIngredient) in recipeDescription.ingredients" :key="neededIngredient.id">  
                        {{neededIngredient.quantity_gr / neededIngredient.servings}}gr {{ neededIngredient.name }}
                    </div>
                </div>
                <div class="col-2">     
                   menu list
                    <div v-for="recipe in menu" :key="recipe.id">
                        {{ recipe}}
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
                recipeDescription: {
                    ingredients:[]
                },
                search:'',
                ingredients: [],
                pantry: [],
                userIngredients: [],
                pantryIngredients:[],
                recipeIngredients:[],
                cart:[],
                menu:[],
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

         this.recipeIngredients = [];
         this.pantryIngredients = [];

                if(this.recipeDescription.ingredients.length != 0){
                    var i = 0;
                    var j = 0;
                    var k = 0;
                    var l = 0;
          
                    //create and array with ingredients for the recipe
                    for (i; i<this.recipeDescription.ingredients.length; i++){
                        this.recipeIngredients.push(this.recipeDescription.ingredients[i])
                    }
                    //create an array with the ingredients in the pantry
                    for(j; j<this.pantry.length; j++){
                        this.pantryIngredients.push(this.pantry[j].name);
                        
                    }
                    //compares the ingredient in the recipe to every single one in the pantry
                
                    for(k; k<this.recipeIngredients.length; k++){
                        if(this.pantryIngredients.includes(this.recipeIngredients[k].name) == true){

                           
                            var nameOfIngredientForRecipe = this.recipeIngredients[k].name;
                            var quantityOfIngredientForRecipe = (this.recipeIngredients[k].quantity_gr/this.recipeIngredients[k].servings);
                            
                            var indexOfIngredientInPantry = this.pantryIngredients.indexOf(this.recipeIngredients[k].name);
                            var nameOfIngredientInPantry = this.pantry[indexOfIngredientInPantry].name;
                            var quantityOfIngredientInPantry = this.pantry[indexOfIngredientInPantry].quantity_gr;

                           
                           //check if user has enough of ingredient for recipe 
                            console.log(quantityOfIngredientInPantry)
                            console.log(quantityOfIngredientForRecipe)
                           console.log((quantityOfIngredientInPantry - quantityOfIngredientForRecipe))
                            if((quantityOfIngredientInPantry - quantityOfIngredientForRecipe)>=0){
                                //if user has enough, subtract portion from pantry
                                this.pantry[indexOfIngredientInPantry].quantity_gr = quantityOfIngredientInPantry- quantityOfIngredientForRecipe

                            }
                            else{
                                //if user does not have enough, add to buy list
                                console.log('not enought need to buy')
                             if(this.cart.length > 0){
                                console.log('looking in cart')
                                var m = 0;
                               
                                var cartItems = []
                                for(m; m<this.cart.length; m++){
                                cartItems.push(this.cart[m].name)
                                } 
                               
                                if(cartItems.includes(this.recipeIngredients[k].name)){
  console.log('found in cart, adding quantity')
       
                                    this.cart[cartItems.indexOf(this.recipeIngredients[k].name)].quantity_gr +=  this.recipeIngredients[k].quantity_gr
                                        }
                                    else{
                                        console.log('not found in cart, adding')
                                    this.cart.push(this.recipeIngredients[k])  
                                    }  
                               
                           }else{
                                 console.log('oh!, first item')
                                   this.cart.push(this.recipeIngredients[k])  
                           }

                                
                                
                            }
                        }else{
                            console.log('not found in pantry, looking for ingredient in cart')
                           //look for it in the cart, remember that the first time you check, the cart is empty!

                          
                           if(this.cart.length > 0){
                                console.log('looking in cart')
                                var m = 0;
                               
                                var cartItems = []
                                for(m; m<this.cart.length; m++){
                                cartItems.push(this.cart[m].name)
                                } 
                               
                                if(cartItems.includes(this.recipeIngredients[k].name)){
  console.log('found in cart, adding quantity')
       
                                    this.cart[cartItems.indexOf(this.recipeIngredients[k].name)].quantity_gr +=  this.recipeIngredients[k].quantity_gr
                                        }
                                    else{
                                        console.log('not found in cart, adding')
                                    this.cart.push(this.recipeIngredients[k])  
                                    }  
                               
                           }else{
                                 console.log('oh!, first item')
                                   this.cart.push(this.recipeIngredients[k])  
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
            .then(response => this.recipeDescription = response.data)
    
         
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