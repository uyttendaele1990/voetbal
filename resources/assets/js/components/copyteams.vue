<template>
   <div> 
    <!-- v-for value in testing  
      v-if testing.team_id == id-->
          <a v-if='(testing[0] !== "") && (testing[0])' href="#" @click.prevent="emailIt" class='btn btn-danger' style='border-radius:10px'>
           Stop <span class="glyphicon glyphicon-envelope" style='margin-left:15px'></span>
          </a>
          <a v-else href='#' @click.prevent="emailIt" class='btn btn-success' style='border-radius:10px;'>
          Volg
          <span class="glyphicon glyphicon-envelope" style='margin-left:15px'></span>
         </a>          
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
          counter:0,
          testing: this.email        
        }
      }, 
        props:[
            'id', 'likes', 'email'
        ],
        created(){
          this.counter = this.likes
        },
        methods:{
          // beforeMount(){
          //     axios.post('/getUser')
          //     .then(response => {
          //         this.user = response.data;
          //     console.log(response);
          //   })
          //   .catch(function (error) {
          //     console.log(error);
          //   });
          // },
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
          emailIt(){
           axios.post('/saveMail', {
            id: this.id
            })
              .then(response => {
              if(response.data == 'deleted'){
              this.testing = '';
              } else {
              this.testing = 'ok';
              }
            })
            .catch(function (error) {
              console.log(error);
            });
             axios.post('/getUser')
            .then(response => {
                this.user = response.data;
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          });
          }
        }
    }
</script>
