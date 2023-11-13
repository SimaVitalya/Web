
<script>

export default {

  name: "Chat",
  data() {
    return {
      messages: [],
      textMessage: '',
    }
  },
  created() {
    if (window.Echo) {
      console.log('Echo created работает');
    } else {
      console.log('Echo created не работае!');
    }
  },
  mounted() {
    console.log(Echo.channel('store_message'))

    Echo.channel('store_message')
        .listen('.store_message', (message) => {
          this.messages.push(message);
          console.log('echo mounted');
        })
  },
  methods: {
    sendMessage() {
      axios.post('/message', {body: this.textMessage})
          .then(res => {
            this.messages.push(this.textMessage);
            this.textMessage = ''
            // console.log(res);
          })
    }
  }
}
</script>

<template>

  <div>
    <hr>
    <div>
      <div>
        <textarea class="form-control" rows="10" readonly="">{{ messages.join('\n') }}</textarea>
        <hr>
        <input type="text" class="form-control" v-model="textMessage" @keyup.enter="sendMessage">
        <p>{{ textMessage }}</p>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>
