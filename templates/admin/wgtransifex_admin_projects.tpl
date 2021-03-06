<!-- Header -->
<{include file='db:wgtransifex_admin_header.tpl' }>

<{if $projects_list}>
	<table class='table table-bordered'>
		<thead>
			<tr class='head'>
				<th class="center"><{$smarty.const._AM_WGTRANSIFEX_PROJECT_ID}></th>
				<th class="center"><{$smarty.const._AM_WGTRANSIFEX_PROJECT_DESCRIPTION}></th>
				<th class="center"><{$smarty.const._AM_WGTRANSIFEX_PROJECT_SOURCE_LANGUAGE_CODE}></th>
				<th class="center"><{$smarty.const._AM_WGTRANSIFEX_PROJECT_SLUG}></th>
				<th class="center"><{$smarty.const._AM_WGTRANSIFEX_PROJECT_NAME}></th>
				<th class="center"><{$smarty.const._AM_WGTRANSIFEX_PROJECT_STATUS}></th>
				<th class="center"><{$smarty.const._AM_WGTRANSIFEX_RESOURCES_NB}></th>
				<th class="center"><{$smarty.const._AM_WGTRANSIFEX_TRANSLATIONS_NB}></th>
				<th class="center"><{$smarty.const._AM_WGTRANSIFEX_PROJECT_DATE}></th>
				<th class="center"><{$smarty.const._AM_WGTRANSIFEX_PROJECT_SUBMITTER}></th>
				<th class="center width10"><{$smarty.const._AM_WGTRANSIFEX_FORM_ACTION}></th>
			</tr>
		</thead>
		<{if $projects_count}>
		<tbody>
			<{foreach item=project from=$projects_list}>
			<tr class='<{cycle values='odd, even'}>'>
				<td class='center'><{$project.id}></td>
				<td class='center'><{$project.description}></td>
				<td class='center'><{$project.source_language_code}></td>
				<td class='center'><{$project.slug}></td>
				<td class='center'><{$project.name}></td>
				<td class='center'><img src="<{$modPathIcon32}>status<{$project.status}>.png" alt="<{$project.status_text}>" title="<{$project.status_text}>" /></td>
				<td class='center'><{$project.resources}></td>
				<td class='center'><{$project.translations}></td>
				<td class='center'><{$project.date}></td>
				<td class='center'><{$project.submitter}></td>
				<td class="center  width5">
					<a href="projects.php?op=readtx&amp;pro_id=<{$project.id}>" title="<{$smarty.const._AM_WGTRANSIFEX_READTX_PROJECT}>"><img src="<{$modPathIcon16}>readtx.png" alt="<{$smarty.const._AM_WGTRANSIFEX_READTX_PROJECT}>" /></a>
					<a href="projects.php?op=edit&amp;pro_id=<{$project.id}>" title="<{$smarty.const._EDIT}>"><img src="<{xoModuleIcons16 edit.png}>" alt="<{$smarty.const._EDIT}> projects" /></a>
					<a href="projects.php?op=delete&amp;pro_id=<{$project.id}>" title="<{$smarty.const._DELETE}>"><img src="<{xoModuleIcons16 delete.png}>" alt="<{$smarty.const._DELETE}> projects" /></a>
					<a href="resources.php?op=savetx&amp;res_pro_id=<{$project.id}>" title="<{$smarty.const._AM_WGTRANSIFEX_READTX_RESOURCES}>"><img src="<{$modPathIcon16}>resources.png"" alt="<{$smarty.const._AM_WGTRANSIFEX_READTX_RESOURCES}>" /></a>
				</td>
			</tr>
			<{/foreach}>
		</tbody>
		<{/if}>
	</table>
	<div class="clear">&nbsp;</div>
	<{if $pagenav}>
		<div class="xo-pagenav floatright"><{$pagenav}></div>
		<div class="clear spacer"></div>
	<{/if}>
<{/if}>
<{if $form}>
	<{$form}>
<{/if}>
<{if $error}>
	<div class="errorMsg"><strong><{$error}></strong></div>
<{/if}>

<!-- Footer -->
<{include file='db:wgtransifex_admin_footer.tpl' }>
