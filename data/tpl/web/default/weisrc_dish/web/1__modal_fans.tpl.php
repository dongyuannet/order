<?php defined('IN_IA') or exit('Access Denied');?><div id="modal-module-menus" class="modal fade" tabindex="-1">
    <div class="modal-dialog" style="width: 800px;">
        <div class="modal-content">
            <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×
            </button><h3>选择粉丝</h3></div>
            <div class="modal-body" >
                <div class="row">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" value="" id="search-kwd" placeholder="输入粉丝昵称进行搜索" />
                        <span class='input-group-btn'><button type="button" class="btn btn-default" onclick="search_entries();">搜索</button></span>
                    </div>
                </div>
                <div id="module-menus" style="padding-top:5px;"></div>
            </div>
            <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function search_entries() {
        var kwd = $.trim($('#search-kwd').val());
        $.post('<?php  echo $this->createWebUrl('queryfans');?>', {keyword: kwd}, function(dat){
            $('#module-menus').html(dat);
        });
    }
    function select_entry(data) {
        $(':text[name="nickname"]').val(data.nickname);
        $(':hidden[name="from_user"]').val(data.from_user);
        $(':hidden[name="agentid"]').val(data.id);
        $('#modal-module-menus').modal('hide');
        $('.cover img').attr('src', data.headimgurl);
    }
</script>