<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="sidebar-header">

        </div>
        <ul class="menu accordion-menu">
            <li class="droplink">
                <a href="#">
                    <img src="{{ asset('images/patient_red_30.png') }}"/>

                    <p>Pacienți</p>
                    <span class="glyphicon glyphicon-chevron-left" style="float:right;margin-top:-39px;"></span>
                </a>
                <ul class="sub-menu" style="display: none;">
                    <li>
                        <a href="{{ url('medic/add_patient') }}">
                            <img src="{{ asset('images/information_red_20.png') }}"/><br/>
                            Adăugare pacient
                        </a>
                    </li>
                    <li class="active droplink">
                        <a href="{{ url('medic/view_patients') }}">
                            <img src="{{ asset('images/registry_orange_20.png') }}"/><br/>
                            Administrare pacienți
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{ asset('images/chart_blue_20.png') }}"/><br/>
                            Grafice
                        </a>
                    </li>
                </ul>
            </li>
                <li class="droplink">
                    <a href="#">
                        <img src="{{ asset('images/consult_orange_30.png') }}"/>

                        <p>Consultații</p>
                        <span class="glyphicon glyphicon-chevron-left" style="float:right;margin-top:-39px;"></span>
                    </a>
                    <ul class="sub-menu" style="display: none;">
                        <li>
                            <a href="{{ url('medic/add_consult') }}">
                                <img src="{{ asset('images/add_red_20.png') }}"/><br/>
                                Adăugare consultație
                            </a>
                        </li>
                        <li class="droplink">
                            <a href="{{ url('medic/view_generalconsults') }}">
                                <img src="{{ asset('images/edit_orange_20.png') }}"/><br/>
                                Administrare consultații
                            </a>
                        </li>
                    </ul>
                </li>
            <li class="droplink">
                <a href="#">
                    <img src="{{ asset('images/lab_blue_30.png') }}"/>

                    <p>Analize</p>
                    <span class="glyphicon glyphicon-chevron-left" style="float:right;margin-top:-39px;"></span>
                </a>
                <ul class="sub-menu" style="display: none;">
                    <li>
                        <a href="{{ url('medic/add_lab') }}">
                            <img src="{{ asset('images/add_red_20.png') }}"/><br/>
                            Adăugare analize
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('medic/view_labs') }}">
                            <img src="{{ asset('images/edit_orange_20.png') }}"/><br/>
                            Administrare analize
                        </a>
                    </li>
                </ul>
            </li>
            <li class="droplink">
                <a href="#">
                    <img src="{{ asset('images/vaccine_red_30.png') }}"/>

                    <p>Vaccinări</p>
                    <span class="glyphicon glyphicon-chevron-left" style="float:right;margin-top:-39px;"></span>
                </a>
                <ul class="sub-menu" style="display: none;">
                    <li>
                        <a href="{{ url('medic/add_vaccine') }}">
                            <img src="{{ asset('images/add_red_20.png') }}"/><br/>
                            Adăugare vaccinăre
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('medic/view_vaccines') }}">
                            <img src="{{ asset('images/edit_orange_20.png') }}"/><br/>
                            Administrare vaccinări
                        </a>
                    </li>
                </ul>
            </li>
            <li class="droplink">
                <a href="#">
                    <img src="{{ asset('images/recommendation_orange_30.png') }}"/>

                    <p>Recomandări</p>
                    <span class="glyphicon glyphicon-chevron-left" style="float:right;margin-top:-39px;"></span>
                </a>
                <ul class="sub-menu" style="display: none;">
                    <li>
                        <a href="{{ url('medic/add_treatment') }}">
                            <img src="{{ asset('images/add_red_20.png') }}"/><br/>
                            Adăugare recomandare
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('medic/view_treatments') }}">
                            <img src="{{ asset('images/edit_orange_20.png') }}"/><br/>
                            Administrare recomandări
                        </a>
                    </li>
                </ul>
            </li>
            <li class="droplink">
                <a href="#">
                    <img src="{{ asset('images/survey_blue_30.png') }}"/>

                    <p>Chestionare</p>
                    <span class="glyphicon glyphicon-chevron-left" style="float:right;margin-top:-39px;"></span>
                </a>
                <ul class="sub-menu" style="display: none;">
                    <li>
                        <a href="{{ url('medic/add_survey') }}">
                            <img src="{{ asset('images/add_red_20.png') }}"/><br/>
                            Adăugare chestionar
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('medic/view_surveys') }}">
                            <img src="{{ asset('images/edit_orange_20.png') }}"/><br/>
                            Administrare chestionare
                        </a>
                    </li>
                </ul>
            </li>
            </li>
            <li>
                <a href="#">
                    <img src="{{ asset('images/notification_red_30.png') }}"/>

                    <p>Notificări</p>
                </a>
            </li>
        </ul>
    </div>
</div>