<!-- This comment will put IE 6, 7 and 8 in quirks mode -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/xhtml;charset=UTF-8"/>
<title>Apache Portable Runtime: Internal APR support functions</title>
<link href="tabs.css" rel="stylesheet" type="text/css"/>
<link href="search/search.css" rel="stylesheet" type="text/css"/>
<script type="text/javaScript" src="search/search.js"></script>
<link href="doxygen.css" rel="stylesheet" type="text/css"/>
</head>
<body onload='searchBox.OnSelectItem(0);'>
<!-- Generated by Doxygen 1.6.3 -->
<script type="text/javascript"><!--
var searchBox = new SearchBox("searchBox", "search",false,'Search');
--></script>
<div class="navigation" id="top">
  <div class="tabs">
    <ul>
      <li><a href="index.html"><span>Main&nbsp;Page</span></a></li>
      <li><a href="pages.html"><span>Related&nbsp;Pages</span></a></li>
      <li><a href="modules.html"><span>Modules</span></a></li>
      <li><a href="annotated.html"><span>Data&nbsp;Structures</span></a></li>
      <li><a href="files.html"><span>Files</span></a></li>
      <li>
        <div id="MSearchBox" class="MSearchBoxInactive">
        <img id="MSearchSelect" src="search/search.png"
             onmouseover="return searchBox.OnSearchSelectShow()"
             onmouseout="return searchBox.OnSearchSelectHide()"
             alt=""/>
        <input type="text" id="MSearchField" value="Search" accesskey="S"
             onfocus="searchBox.OnSearchFieldFocus(true)" 
             onblur="searchBox.OnSearchFieldFocus(false)" 
             onkeyup="searchBox.OnSearchFieldChange(event)"/>
        <a id="MSearchClose" href="javascript:searchBox.CloseResultsWindow()"><img id="MSearchCloseImg" border="0" src="search/close.png" alt=""/></a>
        </div>
      </li>
    </ul>
  </div>
</div>
<div class="contents">
<h1>Internal APR support functions<br/>
<small>
[<a class="el" href="group___a_p_r.html">Apache Portability Runtime library</a>]</small>
</h1><table border="0" cellpadding="0" cellspacing="0">
<tr><td colspan="2"><h2>Functions</h2></td></tr>
<tr><td class="memItemLeft" align="right" valign="top"><a class="el" href="group__apr__errno.html#gaf76ee4543247e9fb3f3546203e590a6c">apr_status_t</a>&nbsp;</td><td class="memItemRight" valign="bottom"><a class="el" href="group__apr__support.html#ga324ffc66a6d42df2325ce999001c1c36">apr_wait_for_io_or_timeout</a> (<a class="el" href="group__apr__file__io.html#gaa46e4763ac375ea3c7a43ba6f6099e22">apr_file_t</a> *f, <a class="el" href="group__apr__network__io.html#ga49262b223e7434746e1f1737659aa2c3">apr_socket_t</a> *s, int for_read)</td></tr>
</table>
<hr/><h2>Function Documentation</h2>
<a class="anchor" id="ga324ffc66a6d42df2325ce999001c1c36"></a><!-- doxytag: member="apr_support.h::apr_wait_for_io_or_timeout" ref="ga324ffc66a6d42df2325ce999001c1c36" args="(apr_file_t *f, apr_socket_t *s, int for_read)" -->
<div class="memitem">
<div class="memproto">
      <table class="memname">
        <tr>
          <td class="memname"><a class="el" href="group__apr__errno.html#gaf76ee4543247e9fb3f3546203e590a6c">apr_status_t</a> apr_wait_for_io_or_timeout </td>
          <td>(</td>
          <td class="paramtype"><a class="el" href="group__apr__file__io.html#gaa46e4763ac375ea3c7a43ba6f6099e22">apr_file_t</a> *&nbsp;</td>
          <td class="paramname"> <em>f</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype"><a class="el" href="group__apr__network__io.html#ga49262b223e7434746e1f1737659aa2c3">apr_socket_t</a> *&nbsp;</td>
          <td class="paramname"> <em>s</em>, </td>
        </tr>
        <tr>
          <td class="paramkey"></td>
          <td></td>
          <td class="paramtype">int&nbsp;</td>
          <td class="paramname"> <em>for_read</em></td><td>&nbsp;</td>
        </tr>
        <tr>
          <td></td>
          <td>)</td>
          <td></td><td></td><td></td>
        </tr>
      </table>
</div>
<div class="memdoc">
<p>Wait for IO to occur or timeout.</p>
<dl><dt><b>Parameters:</b></dt><dd>
  <table border="0" cellspacing="2" cellpadding="0">
    <tr><td valign="top"></td><td valign="top"><em>f</em>&nbsp;</td><td>The file to wait on. </td></tr>
    <tr><td valign="top"></td><td valign="top"><em>s</em>&nbsp;</td><td>The socket to wait on if <em>f</em> is <code>NULL</code>. </td></tr>
    <tr><td valign="top"></td><td valign="top"><em>for_read</em>&nbsp;</td><td>If non-zero wait for data to be available to read, otherwise wait for data to be able to be written. </td></tr>
  </table>
  </dd>
</dl>
<dl class="return"><dt><b>Returns:</b></dt><dd>APR_TIMEUP if we run out of time. </dd></dl>

</div>
</div>
</div>
<!--- window showing the filter options -->
<div id="MSearchSelectWindow"
     onmouseover="return searchBox.OnSearchSelectShow()"
     onmouseout="return searchBox.OnSearchSelectHide()"
     onkeydown="return searchBox.OnSearchSelectKey(event)">
<a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(0)"><span class="SelectionMark">&nbsp;</span>All</a><a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(1)"><span class="SelectionMark">&nbsp;</span>Data Structures</a><a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(2)"><span class="SelectionMark">&nbsp;</span>Files</a><a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(3)"><span class="SelectionMark">&nbsp;</span>Functions</a><a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(4)"><span class="SelectionMark">&nbsp;</span>Variables</a><a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(5)"><span class="SelectionMark">&nbsp;</span>Typedefs</a><a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(6)"><span class="SelectionMark">&nbsp;</span>Enumerations</a><a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(7)"><span class="SelectionMark">&nbsp;</span>Enumerator</a><a class="SelectItem" href="javascript:void(0)" onclick="searchBox.OnSelectItem(8)"><span class="SelectionMark">&nbsp;</span>Defines</a></div>

<!-- iframe showing the search results (closed by default) -->
<div id="MSearchResultsWindow">
<iframe src="" frameborder="0" 
        name="MSearchResults" id="MSearchResults">
</iframe>
</div>

<hr class="footer"/><address style="text-align: right;"><small>Generated on Mon May 23 21:31:33 2011 for Apache Portable Runtime by&nbsp;
<a href="http://www.doxygen.org/index.html">
<img class="footer" src="doxygen.png" alt="doxygen"/></a> 1.6.3 </small></address>
</body>
</html>
