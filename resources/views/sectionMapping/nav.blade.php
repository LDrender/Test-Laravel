<section id="navbar">
    <nav id="nav"  class="noselect">

        <div class="nav barreSearch">

            <form class="search_article">
                <input type="text" name="search" id="search" value placeholder="Recherche" />

                <label for="searchSubmit" class="searchSubmitLabel"><button class="searchSubmitIcon icon solid fa-search"></button></label>
                <input type="submit" name="searchSubmit" id="searchSubmit" value='center'></input>
            </form>
            <div class="developMenu">
                <a id="developMenuIcon" class="developMenuIcon icon solid fa-caret-square-down fa-2x" onclick="addMenuSearch('menuSearch', 'developMenuIcon')"></a>
            </div>
        </div>

        <div class="nav selectArticle">
            <div class="namePlan">
                <span id="no_plan">3-1852301</span>
            </div>
        </div>

        <div class="nav buttonArticle">
            <div class="deroulant"><a>Ajout massif&ensp;</a>
                <ul class="sous">
                    <li><a onclick="addEditeur('newObject', 'newLink')">Ajouter Objets</a></li>
                    <li><a onclick="addEditeur('newLink', 'newObject')">Ajouter Liens</a></li>
                </ul>
            </div>
        </div>

    </nav>

    <div id="menuSearch" class="menuSearch">
        <form id="search_article_filter">
            <table>                       
                <tr>
                    <td>
                    <input type="radio" class="alt" id="filter_objet" name="search_filter" checked value="0">
                    <label for="filter_objet">Recherche d'objet</label>
                    </td>
                    <td>
                    <input type="radio" class="alt" id="filter_no_etude" name="search_filter" value="1">
                    <label for="filter_no_etude">Recherche d'étude</label>
                    </td>
                </tr>
                <tr>
                    <td>
                    <input type="radio" class="alt" id="filter_name_raccordement" name="search_filter" value="2">
                    <label for="filter_name_raccordement">Recherche de raccordement</label>
                    </td>
                    <td>
                </tr>
            </table>
        </form>
    </div>

</section>