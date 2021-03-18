<section id="displayFilter">

    <div id="buttonFilter" class="developFilter" onclick="addMenuFilter()">
        <label class="textCenter">Filtre</label>
        <a id="developFilterMenuIcon" class="icon solid fa-caret-right fa-2x"></a>
    </div>

    <div id="menuFilter" class="menuFilter">
            <form id='display_article_filter'>
                <h3>Afficher :</h3>
                    @foreach($filterGraph as $filter)
                        <input type='hidden' name='{{ $filter["name"] }}' checked value='0'>
                        <input type='checkbox' class='alt' id='{{ $filter["name"] }}' name='{{ $filter["name"] }}' {{ $filter["active"] }} value='1'>
                        <label for='{{ $filter["name"] }}'>{{ $filter["label"] }}</label>
                        <br/>
                        @if($filter["name"] == "display_filter_name_raccordement" || $filter["name"] == "display_filter_color")
                            <hr/>
                        @endif
                    @endforeach

                <!--<input type='reset' class='fit special' id='display_filter_reset' name='display_filter_reset' value='Réinitialiser Filtre'>-->
            </form>
    </div>

</section>