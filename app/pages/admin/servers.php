<?php $this->partial('app/partial/header.php',array('community'=>$this->community,'title'=>$this->title));?><div
    class="main-panel">
    <nav class="navbar navbar-default navbar-fixed">
        <div class="container-fluid">
            <div class="navbar-header"> <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#navigation-example-2"> <span class="sr-only">Toggle navigation</span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand" href="#">Servers</a> </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li> <a href="?logout"> Logout </a> </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Servers List</h4>
                        </div>
                        <div id="message"></div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>Name</th>
                                    <th>IP:Port</th>
                                    <th>Status</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                <?php
                                    $servers = 0;

                                    foreach(dbquery('SELECT * FROM servers WHERE community="' . userCommunity($_SESSION['steamid']) . '"') as $server) {
                                        $servers++;
                                        
                                        if (checkOnline($server['connection']) == true) {
                                            $status = "<span class='label label-success'>Online</span>";
                                        } else {
                                            $status = "<span class='label label-danger'>Offline</span>";
                                        }

                                        echo '
                                            <tr>
                                                <td>' . $server['name'] . '</td>
                                                <td>' . $server['connection'] . '</td>
                                                <td>' . $status . '</td>
                                                <form action="' . $GLOBALS['domainname'] . 'api/delserver" method="post" onsubmit="return submitForm($(this));">
                                                    <input type="hidden" name="serverid" value="' . $server['ID'] . '" />
                                                    <input type="submit" id="remove-server-' . $server['ID'] . '" style="display: none;" />
                                                    <td><span class="label label-danger" onclick=\'$("#remove-server-' . $server[ 'ID'] . '").click();\' style="cursor: pointer;">Remove</span></td>
                                                </form>
                                            </tr>
                                        ';
                                    }

                                    if ($servers == 0) {
                                        echo '
                                            <tr>
                                                <td colspan="5">
                                                    <center> No Servers Added! </center>
                                                </td>
                                            </tr>
                                        ';
                                    }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-warning" style="border-radius: 5px;">
                        <span><center>Make sure install the FiveM Server Resource (New). To download this file click the "Support" tab on the left and visit "Downloads" </center></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Add Server</h4>
                        </div>
                        <div class="content">
                            <form action="<?php echo $GLOBALS['domainname']; ?>api/addserver" method="post" onsubmit="return submitForm($(this));">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group"> <label>Server Name</label> <input type="text" class="form-control" placeholder="Server Name" name="servername"> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group"> <label>Server IP</label> <input type="text" class="form-control" placeholder="Server IP" name="serverip"> </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group"> <label>Server Port</label> <input type="text" class="form-control" placeholder="Server Port" name="serverport"> </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> <label>RCON Password</label> <input type="text" class="form-control" placeholder="RCON Password" name="serverrcon">
                                        </div>
                                    </div>
                                </div>
                                <div id="message"></div> <button type="submit" class="btn btn-info btn-fill" style="width: 100%;">Add Server</button>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><?php $this->partial('app/partial/footer.php');?>