<?php 
// Auteur : José Carlos Gasser
// Date : 23.11.2021
// Descritption : Page de ajout d'un user
?>    
    <div class="container">
        <div class="row">
            <h1>Ajout d'un user</h1>
        </div>
        <div class="row">
            <form action="?action=addUser" method="post" enctype="multipart/form-data">
            <div class="row">
                <label class="col col-1" for="uname">Username </label>
                <input class="col col-3" type="text" name="uname" required/>

            </div>
            <div class="row">
                <label class="col col-1" for="psw">Password </label>
                <input class="col col-3" type="password" name="psw" required/>

            </div>
            <div class="row">
                    <label class="col col-1" for="checkbox">Admin ?</label>
                    <input class="col col-1" type="checkbox" name="admin" id="admin">
            </div>
            <div class="row ">
                <div class=" btnContainer col col-4">
                    <button class="btn btn-primary col col-4" type="submit">Submit</button>

                </div>
                
            </div>
                
                
                
                
            </form>
        </div>
    </div>


