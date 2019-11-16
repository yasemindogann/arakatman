
<!--
ORG CHART
=========================================-->

<div class="container-fluid" style="margin-top:20px">
    <div class="row">
        <?php foreach($data['iliskiler'] as $veri){ ?>
        <div class="col-lg-12 text-center">
            <div class="tree">
                <ul>
                    <li>
                        <a href="#">
                            <div class="container-fluid">
                                <div class="row">
                                    Moodle : <b> <?php echo $veri['ders']; ?></b>
                                </div>
                                <div class="row" style="margin-top: 35px;">
                                    <i class="fa fa-book"></i>
                                </div>
                                <div class="row">
                                    <?php echo $veri['ders_adi']; ?>
                                </div>
                            </div>
                        </a>
                        <?php if($veri['alt_elemanlari']){ ?>
                        <ul>
                            <?php foreach($veri['alt_elemanlari'] as $alt){ ?>
                            <li>
                                <a href="#">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <b><?php echo $alt['obs_kisa_ad']; ?></b>
                                        </div>
                                        <div class="row" style="margin-top: 35px;">
                                            <i class="fa fa-book"></i>
                                        </div>
                                        <div class="row">
                                            <?php echo $alt['obs_adi']; ?>
                                        </div>
                                    </div>

                                </a>
                            </li>
                            <?php }//foreach x ?>
                        </ul>
                        <?php } //if alt elemeanları varsa x?>
                    </li>
                </ul>
            </div>
        </div>
        <?php } ?>
        <hr>
    </div>
</div>


<style>
/*#region Organizational Chart*/
.tree * {
    margin: 0; padding: 0;
}

.tree ul {
    padding-top: 20px; position: relative;

    -transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}

.tree li {
    float: left; text-align: center;
    list-style-type: none;
    position: relative;
    padding: 20px 5px 0 5px;

    -transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}

/*We will use ::before and ::after to draw the connectors*/

.tree li::before, .tree li::after{
    content: '';
    position: absolute; top: 0; right: 50%;
    border-top: 2px solid #696969;
    width: 50%; height: 20px;
}
.tree li::after{
    right: auto; left: 50%;
    border-left: 2px solid #696969;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
    display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child{ padding-top: 0;}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after{
    border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before{
    border-right: 2px solid #696969;
    border-radius: 0 5px 0 0;
    -webkit-border-radius: 0 5px 0 0;
    -moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after{
    border-radius: 5px 0 0 0;
    -webkit-border-radius: 5px 0 0 0;
    -moz-border-radius: 5px 0 0 0;
}
/*Time to add downward connectors from parents*/
.tree ul ul::before{
    content: '';
    position: absolute; top: 0; left: 50%;
    border-left: 2px solid #696969;
    width: 0; height: 20px;
}

.tree li a{
    height: 100px;
    width: 200px;
    padding: 5px 10px;
    text-decoration: none;
    background-color: white;
    color: #8b8b8b;
    font-family: arial, verdana, tahoma;
    font-size: 11px;
    display: inline-block;  
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);

    -transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover, .tree li a:hover+ul li a {
    background: #cbcbcb; color: #000;
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
    border-color:  #94a0b4;
}
/*#endregion*/
</style>