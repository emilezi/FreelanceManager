<ul id="dropdown1" class="dropdown-content">
  <li><a href="index.php?link=user">Profil</a></li>
  <?php
  if($_SESSION['type'] == "admin"){echo "<li><a href='index.php?link=admin'>Admin</a></li>";}
  ?>
</ul>
<ul id="dropdown2" class="dropdown-content">
  <li><a href="index.php?link=bank">Bank</a></li>
  <li><a href="index.php?link=currency">Invoices</a></li>
  <li><a href="index.php?link=charge">Expenses</a></li>
</ul>
<ul id="dropdown3" class="dropdown-content">
  <li><a href="index.php?link=business">Businesses</a></li>
  <li><a href="index.php?link=service">Services</a></li>
  <li><a href="index.php?link=client">Customers</a></li>
</ul>
<nav class="light-blue lighten-1" role="navigation">
<div class="nav-wrapper container"><a id="logo-container" href="index.php" class="brand-logo">FAccounting</a>
    <ul class="right hide-on-med-and-down">
    <li><a class="dropdown-trigger" href="#!" data-target="dropdown3">Activity<i class="material-icons right">arrow_drop_down</i></a></li>
    <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">Accounting<i class="material-icons right">arrow_drop_down</i></a></li>
    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Site<i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>

    <ul id="nav-mobile" class="sidenav">
    <li><a href="index.php?link=bank">Bank</a></li>
    <li><a href="index.php?link=client">Customers</a></li>
    <li><a href="index.php?link=service">Services</a></li>
    <li><a href="index.php?link=currency">Invoices</a></li>
    <li><a href="index.php?link=charge">Expenses</a></li>
    <li><a href="index.php?link=user">Profil</a></li>
    <?php
    if($_SESSION['type'] == "admin"){echo "<li><a href='index.php?link=admin'>Admin</a></li>";}
    ?>
    </ul>
    <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
</div>
</nav>