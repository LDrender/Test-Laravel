<section id="editeur">

    <div id="newObject" class="editeur noselect">
        
        <table>
            <tr>
                <td>
                    <h2>Ajouter / Modifier Objet</h2>
                </td>
                <td>
                    <a class="icon solid fa-times-circle fa-2x exit" onclick="removeEditeur('newObject')"></a>
                </td>
            </tr>
        </table>

        <form id="add_mass_objet_form">
            <table>
                <tr>
                    <td>
                        N° Plan<br/>
                        <textarea class="alt" name="no_plan_add" id="add_mass_objet_no_plan" placeholder="Entrez les numéros de Plan : ( 0000000; 0000000; )" require></textarea>
                    </td>
                </tr>
                <tr>    
                    <td>
                        N° Étude<br/>
                        <input type="text" class="alt" name="no_etude_add" id="add_mass_objet_no_etude" size="25" placeholder="Entrez le numéro d'étude" require></input>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="fit special" value="AJOUTER" id="add_mass_objet_submit">
                    </td>
                </tr>
            </table>
        </form>

    </div>

    <div id="newLink" class="editeur noselect">
        
        <table>
            <tr>
                <td>
                    <h2>Ajouter / Modifier Link</h2>
                </td>
                <td>
                    <a class="icon solid fa-times-circle fa-2x exit" onclick="removeEditeur('newLink')"></a>
                </td>
            </tr>
        </table>

        <form id="add_mass_link_form">
            <table>
                <tr>
                    <td>
                        N° Plan principale<br/>
                        <input type="text" class="alt" name="add_mass_link_no_plan_primary" id="add_mass_link_no_plan_primary" placeholder="Entrez le numéro du Plan" require>
                    </td>
                </tr>
                <tr>
                    <td>
                        N° Plan secondaire<br/>
                        <textarea class="alt" name="add_mass_link_no_plan_secondary" id="add_mass_link_no_plan_secondary" placeholder="Exemple multi-liens : ( 0000000; 0000000; )" require></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="fit special" value="AJOUTER" id="add_mass_link_submit">
                    </td>
                </tr>
            </table>
        </form>

    </div>

</section>