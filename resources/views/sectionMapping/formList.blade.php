<!-- Form Use with right click -->
<section id="formList">

    <form id="formObjetAdd" class="formObjet">
        <table>
            <tr>
                <td>
                    <h3>Ajouter un objet</h3>
                </td>
                <td>
                    <a class="icon solid fa-times-circle fa-2x exit" onclick="closeForm()"></a>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    N° Plan<br/>
                    <input type="text" class="alt" name="no_plan_add" id="add_article_no_plan" size="25" placeholder="Entrez le numéro de Plan" require></input>
                </td>
            </tr>
            <tr>    
                <td>
                    N° Étude<br/>
                    <input type="text" class="alt" name="no_etude_add" id="add_article_no_etude" size="25" placeholder="Entrez le numéro d'étude" require></input>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" class="fit special" value="AJOUTER" id="add_article_submit">
                </td>
            </tr>
        </table>
    </form>
    
    <form id="formObjetEditing" class="formObjet">
        <table>
            <tr>
                <td>
                    <h3>Modifier objet</h3>
                </td>
                <td>
                    <a class="icon solid fa-times-circle fa-2x exit" onclick="closeForm()"></a>
                </td>
            </tr>
        </table>
        <input type="hidden"  name="article_id" id="update_article_id" checked></input>
        <table>
            <tr>
                <td>
                    N° Plan<br/>
                    <input type="text" class="alt" name="article_no_plan" id="update_article_no_plan" size="25" placeholder="Créez / Sélectionnez un Plan" readonly></input>
                </td>
                <td>
                    Code Article<br/>
                    <input type="text" class="alt" name="article_code_art" id="update_article_code_art" size="25" placeholder="Entrez le code article"></input>
                </td>
            </tr>
            <tr>
                <td>
                    Désignation<br/>
                    <input type="text" class="alt" name="article_designation" id="update_article_designation" size="25" placeholder="Entrez la désignation"></input>
                </td>
                <td>
                    N° Étude<br/>
                    <input type="text" class="alt" name="article_no_etude" id="update_article_no_etude" size="25" placeholder="Entrez le numéro d'étude"></input>
                </td>
            </tr>
            <tr>
                <td>
                    Révision<br/>
                    <input type="text"  class="alt" name="article_revision" id="update_article_revision" size="25" placeholder="Entrez le numéro de révision"></input>
                </td>
                <td class="select-wrapper">
                    Type de DM<br/>
                    <select class="alt" name="article_type_art" id="update_article_type_art">
                        <option value="0"></option>
                        <option value="1">Implant</option>
                        <option value="2">Instrument</option>
                        <option value="3">Logiciel</option>
                        <option value="4">Outillages</option>
                        <option value="5">Plateaux</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Image<br/>
                    <input type="text"  class="alt" name="article_image" id="update_article_image" size="25" placeholder="Entrez le lien de l'image"></input>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" class="fit special" value="MODIFIER" id="update_article_submit"></input>
                </td>
            </tr>
        </table>
    </form>
    
    <form id="formObjetDuplicate" class="formObjet">
        <table>
            <tr>
                <td>
                    <h3>Dupliquer Objet</h3>
                </td>
                <td>
                    <a class="icon solid fa-times-circle fa-2x exit" onclick="closeForm()"></a>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    Nom de l'objet sélectionner :
                    <input type="text" class="alt" name="article_duplicate_no_plan_selected" id="no_plan_duplicate_article_selected" placeholder="Entrez le nom de objet sélectionner" readonly></input>
                </td>
            </tr>
            <tr>
                <td>
                    Nom du nouvel objet  :
                    <input type="text" class="alt" name="article_duplicate_no_plan" id="no_plan_duplicate_article" placeholder="Entrez le nom du nouvel objet" required></input>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" class="fit special extra" value="DUPLIQUER" id="duplicate_article_submit"></input>
                </td>
            </tr>
        </table>
    </form>
    
    <form id="formObjetAddRaccordement" class="formObjet">
        <table>
            <tr>
                <td>
                    <h3>Ajouter un raccordement</h3>
                </td>
                <td>
                    <a class="icon solid fa-times-circle fa-2x exit" onclick="closeForm()"></a>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    Nom du raccordement<br/>
                    <input type="text" class="alt" name="no_plan_add" id="add_article_no_plan" size="25" placeholder="Entrez le nom du raccordement" require></input>
                </td>
            </tr>
            <tr>    
                <td>
                    N° Étude<br/>
                    <input type="text" class="alt" name="no_etude_add" id="add_article_no_etude" size="25" placeholder="Entrez le numéro d'étude" require></input>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" class="fit special" value="AJOUTER" id="add_article_submit">
                </td>
            </tr>
        </table>
    </form>
    
    <form id="formObjetSelectRaccordement" class="formObjet">
        <table>
            <tr>
                <td>
                    <h3>Sélectionner un raccordement</h3>
                </td>
                <td>
                    <a class="icon solid fa-times-circle fa-2x exit" onclick="closeForm()"></a>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    Nom du raccordement<br/>
                    <input type="text" class="alt" name="no_plan_add" id="add_article_no_plan" size="25" list="listRaccordement" placeholder="Entrez le nom du raccordement" require></input>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" class="fit special" value="AJOUTER" id="add_article_submit">
                </td>
            </tr>
        </table>
    </form>
    
    <form id="formObjetEditRaccordement" class="formObjet">
        <table>
            <tr>
                <td>
                    <h3>Modification du raccordement</h3>
                </td>
                <td>
                    <a class="icon solid fa-times-circle fa-2x exit" onclick="closeForm()"></a>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td colspan="2">
                    Nom du raccordement<br/>
                    <input type="text" class="alt" name="no_plan_add" id="add_article_no_plan" size="25" placeholder="Entrez le nom du raccordement" require></input>
                </td>
            </tr>
            <tr>
                <td>
                    N° Étude<br/>
                    <input type="text" class="alt" name="article_no_etude" id="update_article_no_etude" size="25" placeholder="Entrez le numéro d'étude"></input>
                </td>
                <td>
                    Révision<br/>
                    <input type="text" class="alt" name="article_designation_fr" id="update_article_designation_fr" size="25" placeholder="Entrez la révision"></input>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Justificatif<br/>
                    <input type="text" class="alt" name="no_plan_add" id="add_article_no_plan" size="25" placeholder="Entrez le nom du justificatif" require></input>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" class="fit special" value="AJOUTER" id="add_article_submit">
                </td>
            </tr>
        </table>
    </form>

</section>