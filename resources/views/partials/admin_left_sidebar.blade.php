<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="sidebar-header">

        </div>
        <ul class="menu accordion-menu">
            <li class="droplink {{ active(['admin/add_medic', 'admin/view_medics']) }}">
                <a href="#">
                    <img src="{{ asset('images/doctor_blue_30.png') }}"/>

                    <p>Medici</p>
                    <span class="glyphicon glyphicon-chevron-left" style="float:right;margin-top:-39px;"></span>
                </a>
                <ul class="sub-menu" style="display: none;">
                    <li class="{{ active('admin/add_medic') }}">
                        <a href="{{ url('admin/add_medic') }}">
                            <img src="{{ asset('images/add_green_20.png') }}"/><br/>

                            <p>Adaugă medici</p>
                        </a>
                    </li>
                    <li class="{{ active('admin/view_medics') }}">
                        <a href="{{ url('admin/view_medics') }}">
                            <img src="{{ asset('images/edit_orange_20.png') }}"/><br/>

                            <p>Administrează medici</p>
                        </a>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
</div>a