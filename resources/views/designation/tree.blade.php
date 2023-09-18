<select id="sel_1" style="width:16em" multiple>
</select>
<script>
var mydata = [
	@include('designation.designationTree', ['parent_designations' => $parent_designations])
];
$("#sel_1").select2ToTree({treeData: {dataArr: mydata}, maximumSelectionLength: 3});
</script>