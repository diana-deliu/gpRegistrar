<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="sidebar-header">

        </div>
        <ul class="menu accordion-menu">
            <li class="droplink active">
                <a href="#">
                    <img src="{{ asset('images/patient_red_30.png') }}"/>

                    <p>Pacienți</p>
                    <span class="glyphicon glyphicon-chevron-left" style="float:right;margin-top:-39px;"></span>
                </a>
                <ul class="sub-menu" style="display: none;">
                    <li>
                        <a href="{{ url('medic/add_patient') }}">
                            <img src="{{ asset('images/add_green_20.png') }}"/><br/>
                            <p>Adăugare pacient</p>
                        </a>
                    </li>
                    <li class="active droplink">
                        <a href="{{ url('medic/view_patients') }}">
                            <img src="{{ asset('images/edit_orange_20.png') }}"/><br/>
                            <p>Administrare pacienți</p>
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
                                <img src="{{ asset('images/add_green_20.png') }}"/><br/>
                                <p>Adăugare consultație</p>
                            </a>
                        </li>
                        <li class="droplink">
                            <a href="{{ url('medic/view_generalconsults') }}">
                                <img src="{{ asset('images/edit_orange_20.png') }}"/><br/>
                                <p>Administrare consultații</p>
                            </a>
                        </li>
                    </ul>
                </li>
            <li class="droplink">
                <a href="#">
                    <img src="{{ asset('images/lab_green_30.png') }}"/>

                    <p>Analize</p>
                    <span class="glyphicon glyphicon-chevron-left" style="float:right;margin-top:-39px;"></span>
                </a>
                <ul class="sub-menu" style="display: none;">
                    <li>
                        <a href="{{ url('medic/add_lab') }}">
                            <img src="{{ asset('images/add_green_20.png') }}"/><br/>
                            <p>Adăugare analize</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('medic/view_labs') }}">
                            <img src="{{ asset('images/edit_orange_20.png') }}"/><br/>
                            <p>Administrare analize</p>
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
                            <img src="{{ asset('images/add_green_20.png') }}"/><br/>
                            <p>Adăugare vaccinăre</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('medic/view_vaccines') }}">
                            <img src="{{ asset('images/edit_orange_20.png') }}"/><br/>
                            <p>Administrare vaccinări</p>
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
                            <img src="{{ asset('images/add_green_20.png') }}"/><br/>
                            <p>Adăugare recomandare</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('medic/view_treatments') }}">
                            <img src="{{ asset('images/edit_orange_20.png') }}"/><br/>
                            <p>Administrare recomandări</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="droplink">
                <a href="#">
                    <img src="{{ asset('images/survey_green_30.png') }}"/>

                    <p>Chestionare</p>
                    <span class="glyphicon glyphicon-chevron-left" style="float:right;margin-top:-39px;"></span>
                </a>
                <ul class="sub-menu" style="display: none;">
                    <li>
                        <a href="{{ url('medic/add_survey') }}">
                            <img src="{{ asset('images/add_green_20.png') }}"/><br/>
                            <p>Adăugare chestionar</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('medic/view_surveys') }}">
                            <img src="{{ asset('images/edit_orange_20.png') }}"/><br/>
                            <p>Administrare chestionare</p>
                        </a>
                    </li>
                </ul>
            </li>
            </li>
        </ul>
    </div>
</div>