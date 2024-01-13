let editKey = -1;

function editItemName(id, key)
{
    if (editKey == key) return;
    if (editKey != -1) {
        updateItemName(id, editKey);
    }

    editKey = key;

    item = document.querySelector('li[data-key="' + key + '"]');
    if (item) {
        itemLabel = item.querySelector('label');
        itemInput = item.querySelector('input[type="text"]');

        itemLabel.setAttribute('hidden', '');
        itemInput.removeAttribute('hidden');

        itemInput.value = itemLabel.innerHTML;
        itemInput.setSelectionRange(0, itemInput.value.length);
        itemInput.focus();

        if (itemInput.dataset.has_listeners !== 'true') {
            itemInput.addEventListener('focusout', (event) => {
                event.preventDefault();
                updateItemName(id, row);
            });

            itemInput.addEventListener('keypress', function(event) {
                if (itemInput.value === goalSpan.itemLabel && event.key === 'Enter') {
                    itemInput.setAttribute('hidden', '');
                    itemLabel.removeAttribute('hidden');
                }
            });

            itemInput.setAttribute('data-has_listeners', 'true');
        }
    }
}

function updateItemName(id, key)
{
    item = document.querySelector('li[data-key="' + key + '"]');
    if (item) {
        itemLabel = item.querySelector('label');
        itemInput = item.querySelector('input[type="text"]');

        itemLabel.removeAttribute('hidden');
        itemInput.setAttribute('hidden', '');

        if (itemInput.value != '') {
            itemLabel.innerHTML = itemInput.value;
            updateDatabase_itemName(id, key, itemInput.value);
        } else {
            // tr = table.querySelector('tr[data-row="' + row + '"]');
            // if (tr != null) {
            //     table.deleteRow(tr.rowIndex);
            //     updateDatabase_deleteItem(id, row);
            //     location.reload();
            // }
        }
    }
}

function updateDatabase_addItem(id, key, name)
{
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'js/db_addItem.php', false);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('id=' + id + '&key=' + key + '&name=' + name);
}

function updateDatabase_itemName(id, key, name)
{
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'js/db_updateItemName.php', false);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('id=' + id + '&key=' + key + '&name=' + name);
}

function updateDatabase_itemState(id, key)
{
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'js/db_updateItemState.php', false);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('id=' + id + '&key=' + key);
}

function updateDatabase_deleteItem(id, key)
{
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'js/db_deleteItem.php', false);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('id=' + id + '&key=' + key);
}
