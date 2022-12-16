
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <a class="navbar-brand" href="<?php echo ROOT_URL; ?>"><img src="<?php echo ROOT_URL; ?>includes/img/nav_logo.png" alt="logo" ></a>

  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Начало">
        <a class="nav-link" href="<?php echo ROOT_URL; ?>">
          <i class="fa fa-fw fa-dashboard"></i>
          <span class="nav-link-text">Начало</span>
        </a>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Класове">
        <a class="nav-link" href="<?php echo ROOT_URL; ?>classes/list">
          <i class="fa fa-fw fa-table"></i>
          <span class="nav-link-text">Класове</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Класове">
        <a class="nav-link" href="<?php echo ROOT_URL; ?>student/list">
          <i class="fa fa-fw fa-table"></i>
          <span class="nav-link-text">Ученици</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Класове">
        <a class="nav-link" href="<?php echo ROOT_URL; ?>subject/list">
          <i class="fa fa-fw fa-table"></i>
          <span class="nav-link-text">Предмети</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Учители">
        <a class="nav-link" href="<?php echo ROOT_URL; ?>teacher/list">
          <i class="fa fa-fw fa-table"></i>
          <span class="nav-link-text">Учители</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Учители">
        <a class="nav-link" href="<?php echo ROOT_URL; ?>results/result">
          <i class="fa fa-fw fa-table"></i>
          <span class="nav-link-text">Oценки</span>
        </a>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Учители">
        <a class="nav-link" href="<?php echo ROOT_URL; ?>absence/list">
          <i class="fa fa-fw fa-table"></i>
          <span class="nav-link-text">Отсъствия</span>
        </a>
      </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Добавяне">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
          <i class="fa fa-fw fa-wrench"></i>
          <span class="nav-link-text">Добавяне</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseComponents">
          <li>
            <a href="<?php echo ROOT_URL; ?>subject/add"><i class="fa fa-plus" aria-hidden="true"></i> Предмет</a>
          </li>
          <li>
            <a href="<?php echo ROOT_URL; ?>teacher/add"><i class="fa fa-plus" aria-hidden="true"></i> Учител</a>
          </li>
          <li>
            <a href="<?php echo ROOT_URL; ?>classes/add"><i class="fa fa-plus" aria-hidden="true"></i> Клас</a>
          </li>
          <li>
            <a href="<?php echo ROOT_URL; ?>student/add"><i class="fa fa-plus" aria-hidden="true"></i> Ученик</a>
          </li>
          <li>
            <a href="<?php echo ROOT_URL; ?>results/add"><i class="fa fa-plus" aria-hidden="true"></i> Оценки</a>
          </li>
          <li>
            <a href="<?php echo ROOT_URL; ?>absence/add"><i class="fa fa-plus" aria-hidden="true"></i> Отсъствия</a>
          </li>
        </ul>
      </li>

    </ul>
    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li>
        <span class="nav-greeting">Добре дошъл,
          <?php $userId = $_SESSION['id']; echo $db->getFullNameById($userId); ?>!</span>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-fw fa-envelope"></i>
          <span class="d-lg-none">Messages
            <span class="badge badge-pill badge-primary">12 New</span>
          </span>
          <span class="indicator text-primary d-none d-lg-block">
            <i class="fa fa-fw fa-circle"></i>
          </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="messagesDropdown">
          <h6 class="dropdown-header">New Messages:</h6>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">
            <strong>David Miller</strong>
            <span class="small float-right text-muted">11:21 AM</span>
            <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">
            <strong>Jane Smith</strong>
            <span class="small float-right text-muted">11:21 AM</span>
            <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">
            <strong>John Doe</strong>
            <span class="small float-right text-muted">11:21 AM</span>
            <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item small" href="#">View all messages</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-fw fa-bell"></i>
          <span class="d-lg-none">Alerts
            <span class="badge badge-pill badge-warning">6 New</span>
          </span>
          <span class="indicator text-warning d-none d-lg-block">
            <i class="fa fa-fw fa-circle"></i>
          </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="alertsDropdown">
          <h6 class="dropdown-header">New Alerts:</h6>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">
            <span class="text-success">
              <strong>
                <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
            </span>
            <span class="small float-right text-muted">11:21 AM</span>
            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">
            <span class="text-danger">
              <strong>
                <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
            </span>
            <span class="small float-right text-muted">11:21 AM</span>
            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">
            <span class="text-success">
              <strong>
                <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
            </span>
            <span class="small float-right text-muted">11:21 AM</span>
            <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item small" href="#">View all alerts</a>
        </div>
      </li>
      <li class="nav-item">
        <form class="form-inline my-2 my-lg-0 mr-lg-2">
          <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-primary" type="button">
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form>
      </li>
      <li class="nav-item">
        <button class="btn btn-primary" type="button" name="button" onclick="window.location.href ='<?php echo ROOT_URL ?>account/logout';">LOGOUT</button>
      </li>
    </ul>
  </div>
</nav>
