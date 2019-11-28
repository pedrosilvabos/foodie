<template>
  <div>
    <div class="container">
      <input type="text" v-model="search" placeholder="Find" />
      this component shows all ingredients existant
      <select>
        <!-- get the user pantry -->
        <option
          v-for="(pantries) in pantry"
          :key="pantries.id"
          :value="pantries.id"
        >{{ pantries }}</option>
      </select>
        <!-- button to save ingredients to pantry -->
      <input
        type="button"
        class="fa fa-minus"
        aria-hidden="true"
        v-on:click="SaveToPantry()"
        value="save"
      />
      <div class="content"></div>
      <div class="row">
        <div class="col-md-6">
          <div v-for="ingredient in ingredients" :key="ingredient"></div>
          <div class="row">
            <div v-for="(pIngredient, index) in filteredIngredients" :key="pIngredient">
              <div class="col-sm-4" style="padding:10px">
                <div class="card" style="width: 7rem; height: 9rem">
                  <img class="card-img-top" :src="GetImagePath(index)" alt="Card image cap" />
                  <div class="card-body">
                    <h5 class="card-title">{{ pIngredient.name }}</h5>
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
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div v-for="(ingredient, index) in pantryArray" :key="ingredient">
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
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      ingredients: [],
      pantry: [],
      pantryId: [],
      search: "",
      pantryArray: [],
      userName: "",
      userId: ""
    };
  },
  created() {
    this.userName = this.user.name;
    this.userId = this.user.id;
    axios
      .get("../api/pantry/" + this.userId) // add user token
      .then(response => (this.pantry = response.data.id));
    axios
      .get("../api/ingredients") // add user token
      .then(response => (this.ingredients = response.data));
      if(this.userId == 0){
        this.pantry = [];
      }
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
      this.pantryArray.push(ingredient);
      this.ClearCart();
      this.$emit('ingredientArray', this.pantryArray)
    },
    RemoveIngredientFromPantry: function(index) {
      this.pantryArray.splice(index, 1);
    },
    ClearCart: function() {
      this.ingredient = {};
    },
    GetImagePath(index) {
      return this.ingredients[index].ingredient_icon;
    },
    SaveToPantry() {
      axios.put("../api/pantry/" + this.userId, {
        ingredient: this.pantryArray
      });
    }
  }
};
</script>
