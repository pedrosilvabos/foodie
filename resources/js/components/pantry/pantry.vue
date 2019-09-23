<template>
  <div id="app">
    <UsrMsg @inputData="updateMessage" />
  </div>
</template>

<script>
import UsrMsg from "./components/UsrMsg";

export default {
  name: "App",
  components: {
    UsrMsg
  },
  data: function() {
    return {
      childData: ""
    };
  },
  methods: {
    updateMessage(variable) {
      this.childData= variable;
    }
  }
};
</script>