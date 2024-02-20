<template>
    <div class="row">
        <div class="col-12 text-end">
            <small>
                <a href="dsgvo">
                    Datenschutz
                    <sup class="icon anchor"></sup>
                </a>
                &nbsp;&nbsp; | &nbsp;&nbsp;
                <a href="impressum">
                    Impressum 
                    <sup class="icon anchor"></sup>
                </a>
                &nbsp;&nbsp; | &nbsp;&nbsp;
                    <!-- Authentication Links -->
                    <template v-if="userID>0">
                        <small v-html="userName"></small> &nbsp;&nbsp; 
                            <a href="logout"
                                title="abmelden"
                                class="nosign btn btn-sm btn-danger"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">                            
                                    <i class="nav-icon fa fa-power-off"></i>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>        
                            </a>                                                            
                    </template>
                    <template v-else>
                        <a  href="login">anmelden</a>
                    </template>
            </small>
        </div>            
    </div>

</template>

<script>
    export default {
      name: 'GermanHeader',

      data() {
        return {
            userID: -1,
            userName: '',
        }
      },

      computed: {

      },

      methods: {
        getUser(val) {
            let self=this;
            axios.get(`api/users/${val}`)
                .then(function(response) {
                    if ((response.data))
                    {
                        console.log(response.data);
                        self.userName = response.data[0].name;
                    }
                })
                .catch(() => {
                    PersistantToast.fire({
                        icon: 'error',
                        title: 'Anmeldedaten konnten nicht geladen werden!'
                    })
                });            
        }, 
      },
      mounted() {
          this.userID = $('#userID').val();
          if (this.userID>0) 
          {
              this.getUser(this.userID)
          }
      }
    }
</script>
