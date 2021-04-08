
var length = $('#total').val();
//alert(length);
for(i=0;i<=length;i++){
	if($("#allcollection"+i).length){
		//alert("#allcollection"+i);
		
		var tempallcollection = eval('allcollection'+i);
		Sortable.create(tempallcollection, {
			
			animation: 500,
			swapClass: 'highlight',
			group: {
				name: 'shared',
				// pull: 'clone'
			},
		    ghostClass: 'blue-background-class'
		});
	}
	if($("#selectedCollection"+i).length){
		var tempselectedCollection = eval('selectedCollection'+i);
		Sortable.create(tempselectedCollection, {
		    animation: 500,
			group: {
				name: 'shared',
				// pull: 'clone'
			},
		    ghostClass: 'blue-background-class'
		});
	}

}


