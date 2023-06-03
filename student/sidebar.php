<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main Menu</span>
                </li>

                <?php if($page == 'dashboard'): ?>
                <li class="submenu active">
                    <a href="?page=dashboard"><i class="feather-grid"></i> <span>Dashboard</span></a>
                </li>
                <?php else: ?>
                <li class="submenu">
                    <a href="?page=dashboard"><i class="feather-grid"></i> <span>Dashboard</span></a>
                </li>
                <?php endif; ?>

                <?php if($page == 'request'): ?>
                <li class="submenu active">
                    <a href="?page=request"><i class="feather-book"></i> <span>Request</span></a>
                </li>
                <?php else: ?>
                <li class="submenu">
                    <a href="?page=request"><i class="feather-book"></i> <span>Request</span></a>
                </li>
                <?php endif; ?>

                <?php if($page == 'activity'): ?>
                    <li class="submenu active">
                        <a href="?page=activity"><i class="feather-activity"></i> <span>Activity</span></a>
                    </li>
                <?php else: ?>
                    <li class="submenu">
                        <a href="?page=activity"><i class="feather-activity"></i> <span>Activity</span></a>
                    </li>
                <?php endif; ?>

                <!-- <li class="submenu">
                    <a href="javascript::void()"><i class="fas fa-graduation-cap"></i> <span> Students</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="?page=dashboard">Student List</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript::void()"><i class="fas fa-book-reader"></i> <span> Library</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="?page=dashboard">Master List</a></li>
                        <li><a href="?page=dashboard">View Requests</a></li>
                    </ul>
                </li> -->
            </ul>
        </div>
    </div>
</div>