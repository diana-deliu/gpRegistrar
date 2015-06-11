<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="sidebar-header">

        </div>
        <ul class="menu accordion-menu">
            <li class="active">
                <a href="{{ url('patient/view_registry') }}">
                    <img src="{{ asset('images/registry_red_30.png') }}"/>

                    <p>Fișă medicală</p>
                </a>
            </li>
            <li>
                <a href="{{ url('patient/view_consults') }}">
                    <img src="{{ asset('images/consult_orange_30.png') }}"/>

                    <p>Consultații</p>
                </a>
            <li>
                <a href="{{ url('patient/view_labs') }}">
                    <img src="{{ asset('images/lab_green_30.png') }}"/>

                    <p>Analize</p>
                </a>
            </li>
            <li>
                <a href="{{ url('patient/view_vaccines') }}">
                    <img src="{{ asset('images/vaccine_red_30.png') }}"/>

                    <p>Vaccinări</p>
                </a>
            </li>
            <li>
                <a href="{{ url('patient/view_treatments') }}">
                    <img src="{{ asset('images/recommendation_orange_30.png') }}"/>

                    <p>Recomandări</p>
                </a>
            </li>
            <li>
                <a href="{{ url('patient/view_surveys') }}">
                    <img src="{{ asset('images/survey_green_30.png') }}"/>

                    <p>Chestionare</p>
                </a>
            </li>
            </li>
        </ul>
    </div>
</div>