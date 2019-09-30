<template>
  <div>
    <input type="text" v-model="search" placeholder="Find" />
    <div class="content">
      <div class="container">
        <div class="row">
          <div v-for="ingredient in ingredients"></div>
     
            <div v-for="(pIngredient, index) in filteredIngredients">
             <div class="col-sm-4" style="padding:10px">
              <div class="card" style="width: 15rem; height: 13rem">
                <img class="card-img-top" :src="GetImagePath(index)" alt="Card image cap" />
                <div class="card-body">
                  <h5 class="card-title">{{ pIngredient.name }}</h5>
                  <p
                    class="card-text"
                  >   Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                     <input
                type="button"
                class="fa fa-plus"
                aria-hidden="true"
                v-on:click="AddIngredientToPantry(pIngredient)"
                value="add"
              />
                </div>
              </div>

           
            </div>
          </div>
          <div class="col">
            <div v-for="(ingredient, index) in pantry">
              {{ ingredient.name }}
              <input
                type="button"
                class="fa fa-minus"
                aria-hidden="true"
                v-on:click="RemoveIngredientFromPantry(index)"
                value="remove"
              />
            </div>
          </div>
          <input
            type="button"
            class="fa fa-minus"
            aria-hidden="true"
            v-on:click="SaveToPantry()"
            value="save"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      ingredients: [],
      pantry: [],
      search: ""
    };
  },
  created() {
    axios
      .get("../api/ingredients") // add user token
      .then(response => (this.ingredients = response.data));
  },
  computed: {
    filteredIngredients: function() {
      return this.ingredients.filter(ingredient => {
        return ingredient.name.toLowerCase().match(this.search.toLowerCase());
      });
    }
  },
  methods: {
    AddIngredientToPantry: function(ingredient) {
      this.pantry.push(ingredient);
      this.ClearCart();
    },
    RemoveIngredientFromPantry: function(index) {
      this.pantry.splice(index, 1);
    },
    ClearCart: function() {
      this.ingredient = {};
    },
    GetImagePath(index) {
      return this.ingredients[index].ingredient_icon;
    },
    SaveToPantry() {
      axios.put("../api/pantry/1", {
        //hard coded pantry id
        ingredient: this.pantry
      });
    }
  }
};
</script>

<style>
</style>