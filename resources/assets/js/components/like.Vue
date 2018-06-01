<template>
   <div>          
     <a href="#" @click.prevent="likeIt" class="btn btn-info btn-md" style='border-radius:10px;'>
      {{ counter }}
        <span class="glyphicon glyphicon-thumbs-up"></span> Like
     </a>
   </div>
</template>

<script>
    export default {
      data(){
        return{
          counter:0       
        }
      }, 
        created(){
          this.counter = this.likes
        },
        methods:{
          beforeMount(){
             axios.post('/getUser')
               .then(response => {
                   this.user = response.data;
               console.log(this.user);
             })
             .catch(function (error) {
               console.log(error);
             });
          },
          likeIt(){
            axios.post('/saveLike', {
            id: this.id
            })
              .then(response => {
              if(response.data == 'deleted'){
              this.counter -= 1;
              } else {
              this.counter += 1;
              }
            })
            .catch(function (error) {
              console.log(error);
            });
          },
        }
    }
</script>
