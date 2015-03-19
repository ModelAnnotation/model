<link rel="stylesheet" href="iscaffold/test.css" type="text/css" media="screen" />
<div id="leftcol">we have a left column here with test.tpl 

                <div class="content">
                    <div class="inner">
                        <h3>List of {$table_name}</h3>

                        {if !empty( $rules_data )}
                            <table class="table">
                            	<thead>
                                    <th width="20"> </th>

			<th>Molecule</th>

                            	</thead>
                            	<tbody>
                              {* *} {print_r($rules_data)}
                                	{foreach $rules_data as $row}
                                        <tr class="{cycle values='odd,even'}">
                <td>{$row.idmolecule}</td>
				<td>{$row.molecule}</td>
             {*   <td><a href="http://www.uniprot.org/uniprot/{$row.link}" target="_blank"><img alt="{$row.link}"/></a></td>
				<td>{$row.comment}</td>*}

                                            <td width="20">
                                                <a href='index.php/molecule/showall/{$row.idmolecule}'><img src="iscaffold/images/view.png" alt="Show record" /></a>
                                            </td>
                            		    </tr>
                                	{/foreach}
                            	</tbody>
                            </table>
                        
                        {else}
                            No records found.
                        {/if}

                    </div><!-- .inner -->
                </div><!-- .content -->
</div>
