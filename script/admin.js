var attributeNumber = 0;

function addAttribute() {
    const wrapper = document.getElementById('attributes-wrapper');
    const inputWrapper = document.createElement('div');
    inputWrapper.classList.add('input-wrapper');

    let inputFieldName;
    let inputFieldType;

    inputFieldName = document.createElement('input');
    inputFieldName.setAttribute('type', 'text');
    inputFieldName.setAttribute('placeholder', 'Attribute Name');
    inputFieldName.setAttribute('name', 'attribute_name_' + attributeNumber);
    inputFieldName.setAttribute('required', '');
    inputFieldType = document.createElement('select');
    inputFieldType.setAttribute('name', 'attribute_type_' + attributeNumber);

    option1 = document.createElement('option');
    option1.setAttribute('value', 'boolean');
    option1.innerHTML = 'Boolean';
    option2 = document.createElement('option');
    option2.setAttribute('value', 'number');
    option2.innerHTML = 'Number';
    option3 = document.createElement('option');
    option3.setAttribute('value', 'text');
    option3.innerHTML = 'Text';

    inputFieldType.appendChild(option1);
    inputFieldType.appendChild(option2);
    inputFieldType.appendChild(option3);

    inputWrapper.appendChild(inputFieldName);
    inputWrapper.appendChild(inputFieldType);
    wrapper.appendChild(inputWrapper);
    attributeNumber++;
}