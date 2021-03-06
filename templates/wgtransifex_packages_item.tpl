<i id='pkgId_<{$package.pkg_id}>'></i>
<div class='panel-heading'>
</div>
<div class='panel-body'>
	<span class='col-sm-9 justify'><{$smarty.const._MA_WGTRANSIFEX_PACKAGE_NAME}>: <{$package.name}></span>
	<span class='col-sm-9 justify'><{$smarty.const._MA_WGTRANSIFEX_PACKAGE_DESC}>: <{$package.desc}></span>
	<span class='col-sm-9 justify'><{$smarty.const._MA_WGTRANSIFEX_PACKAGE_LANG_ID}>: <img src="<{$modPathIconFlags}><{$package.lang_flag}>" alt="<{$package.name}>" title="<{$package.name}>" /> <{$package.lang_id}></span>
	<span class='col-sm-9 justify'><{$smarty.const._MA_WGTRANSIFEX_PACKAGE_DATE}>: <{$package.date}></span>
	<span class='col-sm-9 justify'><{$smarty.const._MA_WGTRANSIFEX_PACKAGE_STATUS}>: <{$package.status_text}></span>
</div>
<div class='panel-foot'>
	<div class='col-sm-12 right'>
		<{if $showItem}>
			<a class='btn btn-success right' href='packages.php?op=list&amp;#pkgId_<{$package.pkg_id}>' title='<{$smarty.const._MA_WGTRANSIFEX_PACKAGES_LIST}>'><{$smarty.const._MA_WGTRANSIFEX_PACKAGES_LIST}></a>
		<{else}>
			<a class='btn btn-success right' href='packages.php?op=show&amp;pkg_id=<{$package.pkg_id}>' title='<{$smarty.const._MA_WGTRANSIFEX_DETAILS}>'><{$smarty.const._MA_WGTRANSIFEX_DETAILS}></a>
		<{/if}>
		<a class='btn btn-primary right' href='download.php?op=package&amp;pkg_id=<{$package.pkg_id}>' title='<{$smarty.const._MA_WGTRANSIFEX_DOWNLOAD_PACKAGE}>'><{$smarty.const._MA_WGTRANSIFEX_DOWNLOAD_PACKAGE}></a>
		<a class='btn btn-warning right' href='packages.php?op=broken&amp;pkg_id=<{$package.pkg_id}>' title='<{$smarty.const._MA_WGTRANSIFEX_BROKEN}>'><{$smarty.const._MA_WGTRANSIFEX_BROKEN}></a>
	</div>
</div>
