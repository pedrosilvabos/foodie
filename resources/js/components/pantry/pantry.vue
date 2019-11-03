<template>
  <div id="#apps">
    <input type="text" v-model="search" placeholder="Find" />
    <div class="content">
      {{userName}}'s Pantries
      <div v-for="(pantryItem, index) in pantry" :key="(pantryItem, index)">{{pantryItem}}</div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["user"],
  data() {
    return {
      pantry: [],
      search: "",
      userName: "",
      userId: ""
    };
  },
  created() {
    this.userName = this.user.name;
    this.userId = this.user.id;
    axios
      .get("../api/pantry/" + this.userId) // add user token
      .then(response => (this.pantry = response.data));
  },
  computed: {
    filteredRecipes: function() {
      return this.recipes.filter(recipe => {
        return recipe.recipes_name
          .toLowerCase()
          .match(this.search.toLowerCase());
      });
    }
  },
  methods: {
    GetIngredients(id) {
      axios
        .get("../api/recipes") // add user token
        .then(response => (this.recipes = response.data));
    }
  }
};
</script>
<style>
</style>