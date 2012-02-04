<!-- This comment will put IE 6, 7 and 8 in quirks mode -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/xhtml;charset=UTF-8"/>
<title>Apache Portable Runtime: apr_proc_mutex.h Source File</title>
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
      <li class="current"><a href="files.html"><span>Files</span></a></li>
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
  <div class="tabs">
    <ul>
      <li><a href="files.html"><span>File&nbsp;List</span></a></li>
      <li><a href="globals.html"><span>Globals</span></a></li>
    </ul>
  </div>
<h1>apr_proc_mutex.h</h1><a href="apr__proc__mutex_8h.html">Go to the documentation of this file.</a><div class="fragment"><pre class="fragment"><a name="l00001"></a>00001 <span class="comment">/* Licensed to the Apache Software Foundation (ASF) under one or more</span>
<a name="l00002"></a>00002 <span class="comment"> * contributor license agreements.  See the NOTICE file distributed with</span>
<a name="l00003"></a>00003 <span class="comment"> * this work for additional information regarding copyright ownership.</span>
<a name="l00004"></a>00004 <span class="comment"> * The ASF licenses this file to You under the Apache License, Version 2.0</span>
<a name="l00005"></a>00005 <span class="comment"> * (the &quot;License&quot;); you may not use this file except in compliance with</span>
<a name="l00006"></a>00006 <span class="comment"> * the License.  You may obtain a copy of the License at</span>
<a name="l00007"></a>00007 <span class="comment"> *</span>
<a name="l00008"></a>00008 <span class="comment"> *     http://www.apache.org/licenses/LICENSE-2.0</span>
<a name="l00009"></a>00009 <span class="comment"> *</span>
<a name="l00010"></a>00010 <span class="comment"> * Unless required by applicable law or agreed to in writing, software</span>
<a name="l00011"></a>00011 <span class="comment"> * distributed under the License is distributed on an &quot;AS IS&quot; BASIS,</span>
<a name="l00012"></a>00012 <span class="comment"> * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.</span>
<a name="l00013"></a>00013 <span class="comment"> * See the License for the specific language governing permissions and</span>
<a name="l00014"></a>00014 <span class="comment"> * limitations under the License.</span>
<a name="l00015"></a>00015 <span class="comment"> */</span>
<a name="l00016"></a>00016 
<a name="l00017"></a>00017 <span class="preprocessor">#ifndef APR_PROC_MUTEX_H</span>
<a name="l00018"></a>00018 <span class="preprocessor"></span><span class="preprocessor">#define APR_PROC_MUTEX_H</span>
<a name="l00019"></a>00019 <span class="preprocessor"></span><span class="comment"></span>
<a name="l00020"></a>00020 <span class="comment">/**</span>
<a name="l00021"></a>00021 <span class="comment"> * @file apr_proc_mutex.h</span>
<a name="l00022"></a>00022 <span class="comment"> * @brief APR Process Locking Routines</span>
<a name="l00023"></a>00023 <span class="comment"> */</span>
<a name="l00024"></a>00024 
<a name="l00025"></a>00025 <span class="preprocessor">#include &quot;<a class="code" href="apr_8h.html" title="APR Platform Definitions.">apr.h</a>&quot;</span>
<a name="l00026"></a>00026 <span class="preprocessor">#include &quot;<a class="code" href="apr__pools_8h.html" title="APR memory allocation.">apr_pools.h</a>&quot;</span>
<a name="l00027"></a>00027 <span class="preprocessor">#include &quot;<a class="code" href="apr__errno_8h.html" title="APR Error Codes.">apr_errno.h</a>&quot;</span>
<a name="l00028"></a>00028 
<a name="l00029"></a>00029 <span class="preprocessor">#ifdef __cplusplus</span>
<a name="l00030"></a>00030 <span class="preprocessor"></span><span class="keyword">extern</span> <span class="stringliteral">&quot;C&quot;</span> {
<a name="l00031"></a>00031 <span class="preprocessor">#endif </span><span class="comment">/* __cplusplus */</span>
<a name="l00032"></a>00032 <span class="comment"></span>
<a name="l00033"></a>00033 <span class="comment">/**</span>
<a name="l00034"></a>00034 <span class="comment"> * @defgroup apr_proc_mutex Process Locking Routines</span>
<a name="l00035"></a>00035 <span class="comment"> * @ingroup APR </span>
<a name="l00036"></a>00036 <span class="comment"> * @{</span>
<a name="l00037"></a>00037 <span class="comment"> */</span>
<a name="l00038"></a>00038 <span class="comment"></span>
<a name="l00039"></a>00039 <span class="comment">/** </span>
<a name="l00040"></a>00040 <span class="comment"> * Enumerated potential types for APR process locking methods</span>
<a name="l00041"></a>00041 <span class="comment"> * @warning Check APR_HAS_foo_SERIALIZE defines to see if the platform supports</span>
<a name="l00042"></a>00042 <span class="comment"> *          APR_LOCK_foo.  Only APR_LOCK_DEFAULT is portable.</span>
<a name="l00043"></a>00043 <span class="comment"> */</span>
<a name="l00044"></a><a class="code" href="group__apr__proc__mutex.html#ga75dd95a48a1e855a87b509b522746ed4">00044</a> <span class="keyword">typedef</span> <span class="keyword">enum</span> {
<a name="l00045"></a><a class="code" href="group__apr__proc__mutex.html#gga75dd95a48a1e855a87b509b522746ed4ad9dad69d83d1e112054ad21a7e4e16b3">00045</a>     <a class="code" href="group__apr__proc__mutex.html#gga75dd95a48a1e855a87b509b522746ed4ad9dad69d83d1e112054ad21a7e4e16b3">APR_LOCK_FCNTL</a>,         <span class="comment">/**&lt; fcntl() */</span>
<a name="l00046"></a><a class="code" href="group__apr__proc__mutex.html#gga75dd95a48a1e855a87b509b522746ed4a1d06f73a37dae31233299401c9594b41">00046</a>     <a class="code" href="group__apr__proc__mutex.html#gga75dd95a48a1e855a87b509b522746ed4a1d06f73a37dae31233299401c9594b41">APR_LOCK_FLOCK</a>,         <span class="comment">/**&lt; flock() */</span>
<a name="l00047"></a><a class="code" href="group__apr__proc__mutex.html#gga75dd95a48a1e855a87b509b522746ed4a642536695bd4c233761a15d48b1d6487">00047</a>     <a class="code" href="group__apr__proc__mutex.html#gga75dd95a48a1e855a87b509b522746ed4a642536695bd4c233761a15d48b1d6487">APR_LOCK_SYSVSEM</a>,       <span class="comment">/**&lt; System V Semaphores */</span>
<a name="l00048"></a><a class="code" href="group__apr__proc__mutex.html#gga75dd95a48a1e855a87b509b522746ed4abd5e7cca2c9f6023b541131f3841057a">00048</a>     <a class="code" href="group__apr__proc__mutex.html#gga75dd95a48a1e855a87b509b522746ed4abd5e7cca2c9f6023b541131f3841057a">APR_LOCK_PROC_PTHREAD</a>,  <span class="comment">/**&lt; POSIX pthread process-based locking */</span>
<a name="l00049"></a><a class="code" href="group__apr__proc__mutex.html#gga75dd95a48a1e855a87b509b522746ed4a6d65d9d745e13d8759bd8f1057f27041">00049</a>     <a class="code" href="group__apr__proc__mutex.html#gga75dd95a48a1e855a87b509b522746ed4a6d65d9d745e13d8759bd8f1057f27041">APR_LOCK_POSIXSEM</a>,      <span class="comment">/**&lt; POSIX semaphore process-based locking */</span>
<a name="l00050"></a><a class="code" href="group__apr__proc__mutex.html#gga75dd95a48a1e855a87b509b522746ed4ae91fb435c45216bcf84f506db99d0f19">00050</a>     <a class="code" href="group__apr__proc__mutex.html#gga75dd95a48a1e855a87b509b522746ed4ae91fb435c45216bcf84f506db99d0f19">APR_LOCK_DEFAULT</a>        <span class="comment">/**&lt; Use the default process lock */</span>
<a name="l00051"></a>00051 } <a class="code" href="group__apr__proc__mutex.html#ga75dd95a48a1e855a87b509b522746ed4">apr_lockmech_e</a>;
<a name="l00052"></a>00052 <span class="comment"></span>
<a name="l00053"></a>00053 <span class="comment">/** Opaque structure representing a process mutex. */</span>
<a name="l00054"></a><a class="code" href="group__apr__proc__mutex.html#ga0fae3a1ab686cd1f252c6062e4c97bd2">00054</a> <span class="keyword">typedef</span> <span class="keyword">struct </span><a class="code" href="group__apr__proc__mutex.html#ga0fae3a1ab686cd1f252c6062e4c97bd2">apr_proc_mutex_t</a> <a class="code" href="group__apr__proc__mutex.html#ga0fae3a1ab686cd1f252c6062e4c97bd2">apr_proc_mutex_t</a>;
<a name="l00055"></a>00055 
<a name="l00056"></a>00056 <span class="comment">/*   Function definitions */</span>
<a name="l00057"></a>00057 <span class="comment"></span>
<a name="l00058"></a>00058 <span class="comment">/**</span>
<a name="l00059"></a>00059 <span class="comment"> * Create and initialize a mutex that can be used to synchronize processes.</span>
<a name="l00060"></a>00060 <span class="comment"> * @param mutex the memory address where the newly created mutex will be</span>
<a name="l00061"></a>00061 <span class="comment"> *        stored.</span>
<a name="l00062"></a>00062 <span class="comment"> * @param fname A file name to use if the lock mechanism requires one.  This</span>
<a name="l00063"></a>00063 <span class="comment"> *        argument should always be provided.  The lock code itself will</span>
<a name="l00064"></a>00064 <span class="comment"> *        determine if it should be used.</span>
<a name="l00065"></a>00065 <span class="comment"> * @param mech The mechanism to use for the interprocess lock, if any; one of</span>
<a name="l00066"></a>00066 <span class="comment"> * &lt;PRE&gt;</span>
<a name="l00067"></a>00067 <span class="comment"> *            APR_LOCK_FCNTL</span>
<a name="l00068"></a>00068 <span class="comment"> *            APR_LOCK_FLOCK</span>
<a name="l00069"></a>00069 <span class="comment"> *            APR_LOCK_SYSVSEM</span>
<a name="l00070"></a>00070 <span class="comment"> *            APR_LOCK_POSIXSEM</span>
<a name="l00071"></a>00071 <span class="comment"> *            APR_LOCK_PROC_PTHREAD</span>
<a name="l00072"></a>00072 <span class="comment"> *            APR_LOCK_DEFAULT     pick the default mechanism for the platform</span>
<a name="l00073"></a>00073 <span class="comment"> * &lt;/PRE&gt;</span>
<a name="l00074"></a>00074 <span class="comment"> * @param pool the pool from which to allocate the mutex.</span>
<a name="l00075"></a>00075 <span class="comment"> * @see apr_lockmech_e</span>
<a name="l00076"></a>00076 <span class="comment"> * @warning Check APR_HAS_foo_SERIALIZE defines to see if the platform supports</span>
<a name="l00077"></a>00077 <span class="comment"> *          APR_LOCK_foo.  Only APR_LOCK_DEFAULT is portable.</span>
<a name="l00078"></a>00078 <span class="comment"> */</span>
<a name="l00079"></a>00079 <a class="code" href="group__apr__platform.html#gad7b91b811a172bfa802603c2fb688f98">APR_DECLARE</a>(<a class="code" href="group__apr__errno.html#gaf76ee4543247e9fb3f3546203e590a6c">apr_status_t</a>) <a class="code" href="group__apr__proc__mutex.html#ga57a0ad8cc6209dcbc8cf7c4bdf4a2c22">apr_proc_mutex_create</a>(<a class="code" href="group__apr__proc__mutex.html#ga0fae3a1ab686cd1f252c6062e4c97bd2">apr_proc_mutex_t</a> **mutex,
<a name="l00080"></a>00080                                                 const <span class="keywordtype">char</span> *fname,
<a name="l00081"></a>00081                                                 <a class="code" href="group__apr__proc__mutex.html#ga75dd95a48a1e855a87b509b522746ed4">apr_lockmech_e</a> mech,
<a name="l00082"></a>00082                                                 <a class="code" href="group__apr__pools.html#gaf137f28edcf9a086cd6bc36c20d7cdfb">apr_pool_t</a> *pool);
<a name="l00083"></a>00083 <span class="comment"></span>
<a name="l00084"></a>00084 <span class="comment">/**</span>
<a name="l00085"></a>00085 <span class="comment"> * Re-open a mutex in a child process.</span>
<a name="l00086"></a>00086 <span class="comment"> * @param mutex The newly re-opened mutex structure.</span>
<a name="l00087"></a>00087 <span class="comment"> * @param fname A file name to use if the mutex mechanism requires one.  This</span>
<a name="l00088"></a>00088 <span class="comment"> *              argument should always be provided.  The mutex code itself will</span>
<a name="l00089"></a>00089 <span class="comment"> *              determine if it should be used.  This filename should be the </span>
<a name="l00090"></a>00090 <span class="comment"> *              same one that was passed to apr_proc_mutex_create().</span>
<a name="l00091"></a>00091 <span class="comment"> * @param pool The pool to operate on.</span>
<a name="l00092"></a>00092 <span class="comment"> * @remark This function must be called to maintain portability, even</span>
<a name="l00093"></a>00093 <span class="comment"> *         if the underlying lock mechanism does not require it.</span>
<a name="l00094"></a>00094 <span class="comment"> */</span>
<a name="l00095"></a>00095 <a class="code" href="group__apr__platform.html#gad7b91b811a172bfa802603c2fb688f98">APR_DECLARE</a>(<a class="code" href="group__apr__errno.html#gaf76ee4543247e9fb3f3546203e590a6c">apr_status_t</a>) <a class="code" href="group__apr__proc__mutex.html#ga52c440b92eda07dc9c851a4e98f2ac83">apr_proc_mutex_child_init</a>(<a class="code" href="group__apr__proc__mutex.html#ga0fae3a1ab686cd1f252c6062e4c97bd2">apr_proc_mutex_t</a> **mutex,
<a name="l00096"></a>00096                                                     const <span class="keywordtype">char</span> *fname,
<a name="l00097"></a>00097                                                     <a class="code" href="group__apr__pools.html#gaf137f28edcf9a086cd6bc36c20d7cdfb">apr_pool_t</a> *pool);
<a name="l00098"></a>00098 <span class="comment"></span>
<a name="l00099"></a>00099 <span class="comment">/**</span>
<a name="l00100"></a>00100 <span class="comment"> * Acquire the lock for the given mutex. If the mutex is already locked,</span>
<a name="l00101"></a>00101 <span class="comment"> * the current thread will be put to sleep until the lock becomes available.</span>
<a name="l00102"></a>00102 <span class="comment"> * @param mutex the mutex on which to acquire the lock.</span>
<a name="l00103"></a>00103 <span class="comment"> */</span>
<a name="l00104"></a>00104 <a class="code" href="group__apr__platform.html#gad7b91b811a172bfa802603c2fb688f98">APR_DECLARE</a>(<a class="code" href="group__apr__errno.html#gaf76ee4543247e9fb3f3546203e590a6c">apr_status_t</a>) <a class="code" href="group__apr__proc__mutex.html#ga9af7c9eabf4f99a5a33b41dc322af06f">apr_proc_mutex_lock</a>(<a class="code" href="group__apr__proc__mutex.html#ga0fae3a1ab686cd1f252c6062e4c97bd2">apr_proc_mutex_t</a> *mutex);
<a name="l00105"></a>00105 <span class="comment"></span>
<a name="l00106"></a>00106 <span class="comment">/**</span>
<a name="l00107"></a>00107 <span class="comment"> * Attempt to acquire the lock for the given mutex. If the mutex has already</span>
<a name="l00108"></a>00108 <span class="comment"> * been acquired, the call returns immediately with APR_EBUSY. Note: it</span>
<a name="l00109"></a>00109 <span class="comment"> * is important that the APR_STATUS_IS_EBUSY(s) macro be used to determine</span>
<a name="l00110"></a>00110 <span class="comment"> * if the return value was APR_EBUSY, for portability reasons.</span>
<a name="l00111"></a>00111 <span class="comment"> * @param mutex the mutex on which to attempt the lock acquiring.</span>
<a name="l00112"></a>00112 <span class="comment"> */</span>
<a name="l00113"></a>00113 <a class="code" href="group__apr__platform.html#gad7b91b811a172bfa802603c2fb688f98">APR_DECLARE</a>(<a class="code" href="group__apr__errno.html#gaf76ee4543247e9fb3f3546203e590a6c">apr_status_t</a>) <a class="code" href="group__apr__proc__mutex.html#ga7c41927ce5014374eb4fc66d410f9513">apr_proc_mutex_trylock</a>(<a class="code" href="group__apr__proc__mutex.html#ga0fae3a1ab686cd1f252c6062e4c97bd2">apr_proc_mutex_t</a> *mutex);
<a name="l00114"></a>00114 <span class="comment"></span>
<a name="l00115"></a>00115 <span class="comment">/**</span>
<a name="l00116"></a>00116 <span class="comment"> * Release the lock for the given mutex.</span>
<a name="l00117"></a>00117 <span class="comment"> * @param mutex the mutex from which to release the lock.</span>
<a name="l00118"></a>00118 <span class="comment"> */</span>
<a name="l00119"></a>00119 <a class="code" href="group__apr__platform.html#gad7b91b811a172bfa802603c2fb688f98">APR_DECLARE</a>(<a class="code" href="group__apr__errno.html#gaf76ee4543247e9fb3f3546203e590a6c">apr_status_t</a>) <a class="code" href="group__apr__proc__mutex.html#ga4ecd9a73fbb0e6e6853e5d0769bbb183">apr_proc_mutex_unlock</a>(<a class="code" href="group__apr__proc__mutex.html#ga0fae3a1ab686cd1f252c6062e4c97bd2">apr_proc_mutex_t</a> *mutex);
<a name="l00120"></a>00120 <span class="comment"></span>
<a name="l00121"></a>00121 <span class="comment">/**</span>
<a name="l00122"></a>00122 <span class="comment"> * Destroy the mutex and free the memory associated with the lock.</span>
<a name="l00123"></a>00123 <span class="comment"> * @param mutex the mutex to destroy.</span>
<a name="l00124"></a>00124 <span class="comment"> */</span>
<a name="l00125"></a>00125 <a class="code" href="group__apr__platform.html#gad7b91b811a172bfa802603c2fb688f98">APR_DECLARE</a>(<a class="code" href="group__apr__errno.html#gaf76ee4543247e9fb3f3546203e590a6c">apr_status_t</a>) <a class="code" href="group__apr__proc__mutex.html#gaa692ccd799305e0166fb81f258870830">apr_proc_mutex_destroy</a>(<a class="code" href="group__apr__proc__mutex.html#ga0fae3a1ab686cd1f252c6062e4c97bd2">apr_proc_mutex_t</a> *mutex);
<a name="l00126"></a>00126 <span class="comment"></span>
<a name="l00127"></a>00127 <span class="comment">/**</span>
<a name="l00128"></a>00128 <span class="comment"> * Destroy the mutex and free the memory associated with the lock.</span>
<a name="l00129"></a>00129 <span class="comment"> * @param mutex the mutex to destroy.</span>
<a name="l00130"></a>00130 <span class="comment"> * @note This function is generally used to kill a cleanup on an already</span>
<a name="l00131"></a>00131 <span class="comment"> *       created mutex</span>
<a name="l00132"></a>00132 <span class="comment"> */</span>
<a name="l00133"></a>00133 <a class="code" href="group__apr__platform.html#gad7b91b811a172bfa802603c2fb688f98">APR_DECLARE</a>(<a class="code" href="group__apr__errno.html#gaf76ee4543247e9fb3f3546203e590a6c">apr_status_t</a>) <a class="code" href="group__apr__proc__mutex.html#ga71ec4d283f58e893322f44116e6f8ea2">apr_proc_mutex_cleanup</a>(<span class="keywordtype">void</span> *mutex);
<a name="l00134"></a>00134 <span class="comment"></span>
<a name="l00135"></a>00135 <span class="comment">/**</span>
<a name="l00136"></a>00136 <span class="comment"> * Return the name of the lockfile for the mutex, or NULL</span>
<a name="l00137"></a>00137 <span class="comment"> * if the mutex doesn&#39;t use a lock file</span>
<a name="l00138"></a>00138 <span class="comment"> */</span>
<a name="l00139"></a>00139 
<a name="l00140"></a>00140 <a class="code" href="group__apr__platform.html#gad7b91b811a172bfa802603c2fb688f98">APR_DECLARE</a>(const <span class="keywordtype">char</span> *) <a class="code" href="group__apr__proc__mutex.html#gad4dcc5ec2a5a6ede7be178e13f56377a">apr_proc_mutex_lockfile</a>(<a class="code" href="group__apr__proc__mutex.html#ga0fae3a1ab686cd1f252c6062e4c97bd2">apr_proc_mutex_t</a> *mutex);
<a name="l00141"></a>00141 <span class="comment"></span>
<a name="l00142"></a>00142 <span class="comment">/**</span>
<a name="l00143"></a>00143 <span class="comment"> * Display the name of the mutex, as it relates to the actual method used.</span>
<a name="l00144"></a>00144 <span class="comment"> * This matches the valid options for Apache&#39;s AcceptMutex directive</span>
<a name="l00145"></a>00145 <span class="comment"> * @param mutex the name of the mutex</span>
<a name="l00146"></a>00146 <span class="comment"> */</span>
<a name="l00147"></a>00147 <a class="code" href="group__apr__platform.html#gad7b91b811a172bfa802603c2fb688f98">APR_DECLARE</a>(const <span class="keywordtype">char</span> *) <a class="code" href="group__apr__proc__mutex.html#ga3e5cf6b6fd0736502efd91312d50881c">apr_proc_mutex_name</a>(<a class="code" href="group__apr__proc__mutex.html#ga0fae3a1ab686cd1f252c6062e4c97bd2">apr_proc_mutex_t</a> *mutex);
<a name="l00148"></a>00148 <span class="comment"></span>
<a name="l00149"></a>00149 <span class="comment">/**</span>
<a name="l00150"></a>00150 <span class="comment"> * Display the name of the default mutex: APR_LOCK_DEFAULT</span>
<a name="l00151"></a>00151 <span class="comment"> */</span>
<a name="l00152"></a>00152 <a class="code" href="group__apr__platform.html#gad7b91b811a172bfa802603c2fb688f98">APR_DECLARE</a>(const <span class="keywordtype">char</span> *) <a class="code" href="group__apr__proc__mutex.html#gaf4425adc130f83784c552b6bc1563036">apr_proc_mutex_defname</a>(<span class="keywordtype">void</span>);
<a name="l00153"></a>00153 <span class="comment"></span>
<a name="l00154"></a>00154 <span class="comment">/**</span>
<a name="l00155"></a>00155 <span class="comment"> * Get the pool used by this proc_mutex.</span>
<a name="l00156"></a>00156 <span class="comment"> * @return apr_pool_t the pool</span>
<a name="l00157"></a>00157 <span class="comment"> */</span>
<a name="l00158"></a>00158 <a class="code" href="group__apr__pools.html#ga89ce1d55c7f0c39ea87c88eabd655394">APR_POOL_DECLARE_ACCESSOR</a>(proc_mutex);
<a name="l00159"></a>00159 <span class="comment"></span>
<a name="l00160"></a>00160 <span class="comment">/** @} */</span>
<a name="l00161"></a>00161 
<a name="l00162"></a>00162 <span class="preprocessor">#ifdef __cplusplus</span>
<a name="l00163"></a>00163 <span class="preprocessor"></span>}
<a name="l00164"></a>00164 <span class="preprocessor">#endif</span>
<a name="l00165"></a>00165 <span class="preprocessor"></span>
<a name="l00166"></a>00166 <span class="preprocessor">#endif  </span><span class="comment">/* ! APR_PROC_MUTEX_H */</span>
</pre></div></div>
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

<hr class="footer"/><address style="text-align: right;"><small>Generated on Mon May 23 21:31:32 2011 for Apache Portable Runtime by&nbsp;
<a href="http://www.doxygen.org/index.html">
<img class="footer" src="doxygen.png" alt="doxygen"/></a> 1.6.3 </small></address>
</body>
</html>
