<template>
  <div>
    <h1>Create ingredient</h1>
   <div class="panel panel-default">
    <div class="panel-heading">Create new company</div>
    <div class="panel-body">
        <form v-on:submit="saveForm()">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Ingredient name</label>
                    <input type="text" v-model="ingredient.name" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Ingredient Type</label>
                    <input type="text" v-model="ingredient.type" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Ingredient serving</label>
                    <input type="text" v-model="ingredient.servings" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Ingredient price</label>
                    <input type="text" v-model="ingredient.price" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Ingredient quantity Kg</label>
                    <input type="text" v-model="ingredient.quantity_kg" class="form-control">
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Ingredient Protein</label>
                    <input type="text" v-model="ingredient.proteins" class="form-control">
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Ingredient Calories</label>
                    <input type="text" v-model="ingredient.calories" class="form-control">
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Ingredient lifetime</label>
                    <input type="text" v-model="ingredient.lifetime" class="form-control">
                </div>
            </div>
              <div class="row">
                <div class="col-xs-12 form-group">
                    <label class="control-label">Ingredient icon</label>
                    <input type="text" v-model="ingredient.icon" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <button class="btn btn-success">Create</button>
                </div>
            </div>
            
        </form>
        
     
    </div>
</div>
  </div>
</template>

<script>
    export default {
    data() {
      return {
        dismissSecs: 10,
        dismissCountDown: 0,
        showDismissibleAlert: false,
        ingredient:{
       
          name:'',
          type:'',
          servings:'',
          price:'',
          quantity_kg:'',
          proteins:'',
          calories:'',
          lifetime:'',
          icon:'',

        }
      }
    },
    mounted: function(){
      console.log('Contacts Component Loaded...');
    },
    methods: {
      saveForm: function(){
        console.log(this.ingredient);
        axios.post('../api/ingredients',null, {
          params:{
            name:this.ingredient.name,
            type:this.ingredient.type,
            servings:this.ingredient.servings,
            price:this.ingredient.price,
            quantity_kg:this.ingredient.quantity_kg,
            proteins:this.ingredient.proteins,
            calories:this.ingredient.calories,
            lifetime:this.ingredient.lifetime,
            icon:this.ingredient.icon
          }
        }) // add user token
            .then(response => this.ingredients = response.data)

     
      },
      updateContact: function(id){
          console.log(this.contact);
        console.log('Updating contact '+id+'...');
        return;
      },
       countDownChanged(dismissCountDown) {
        this.dismissCountDown = dismissCountDown
      },
      showAlert() {
        this.dismissCountDown = this.dismissSecs
      }
    }
  }
</script>