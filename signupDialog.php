<div>
  <style>
  .dialog_box{
    width: 500px;
    max-width: 100%;
    }
  </style>

<md-dialog class = "dialog_box">
    <form ng-cloak>
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h1>Sign up today and Start using our Online Notes App</h1>
                <span flex></span>
                <md-button class="md-icon-button" ng-click="close()">
                    <i class="fa fa-times fa-lg"></i>
                </md-button>
            </div>
        </md-toolbar>

        <md-dialog-content>
            <div class="md-dialog-content">
                <form method="get" action="<?php $_PHP_SELF ?>">
                    <md-content layout-padding>
                    <md-input-container class="md-block start">
                        <label>Username</label>
                        <input type="text" ng-model="username" name="username">
                    </md-input-container>

                    <md-input-container class="md-block start">
                        <label>Email Adress</label>
                        <input type="email" ng-model="email">
                    </md-input-container>

                    <md-input-container class="md-block start">
                        <label>Choose a Password</label>
                        <input type="password" ng-model="password">
                    </md-input-container>

                    <md-input-container class="md-block start">
                        <label>Confirm Password</label>
                        <input type="password" ng-model="confirmPassword">
                    </md-input-container>

                    </md-content>

  <input type="submit" name="submit" value="submit">
  <?php if($_GET["username"]){
    echo $_GET["username"];
    console.log($_GET["username"]);
    }
  ?>
                </form>
            </div>
        </md-dialog-content>


        <md-dialog-actions layout="row">

            <md-button  md-no-ink class="md-primary" ng-click="confirm()">
                Sign u
            </md-button>
            <md-button ng-click="cancel()">
                Cancel
            </md-button>
        </md-dialog-actions>
    </form>
</md-dialog>

<!-- <script type="text/javascript">
  confirmTime = function(){
    console.log("gg");
  } -->
</script>
</div>
