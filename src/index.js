import "./index.scss";
import {TextControl, Flex, FlexBlock, FlexItem, Button, Icon} from "@wordpress/components";
import {MediaUpload, MediaUploadCheck} from "@wordpress/block-editor";

wp.blocks.registerBlockType("siluteskc/contact-cards-container", {
    title: "Kontaktų kortelė",
    icon: "id",
    category: "common",
    attributes: {
        nameSurname: {type: "string", default: ""},
        jobPosition: {type: "string", default: ""},
        phoneNumber: {type: "string", default: ""},
        emailAddress: {type: "string", default: ""},
        imgID: {type: "number"},
        imgUrl: {type: "string"},
        imgID2: {type: "number"},
        imgUrl2: {type: "string"},
    },
    edit: EditComponent,
    save: function () {
        return null
    }
});

function EditComponent(props) {
    function updateNameSurname(value){
        props.setAttributes({nameSurname: value})
    }
    function updateJobPosition(value){
        props.setAttributes({jobPosition: value})
    }
    function updatePhoneNumber(value){
        props.setAttributes({phoneNumber: value})
    }
    function updateEmailAddress(value){
        props.setAttributes({emailAddress: value})
    }
    function onFileSelect(img){
        props.setAttributes({imgID: img.id})
        props.setAttributes({imgUrl: img.url})
    }
    function onFileSelect2(img){
        props.setAttributes({imgID2: img.id})
        props.setAttributes({imgUrl2: img.url})
    }

    return (
        <div className="contact-cards__item">    
            <Flex>
                <FlexBlock>
                    <MediaUploadCheck>
                        <MediaUpload onSelect={onFileSelect} value={props.attributes.imgID} render={({open}) => {
                            return <Button variant="primary" onClick={open}>Pilka nuotrauka</Button>
                        }} />
                    </MediaUploadCheck>
                    <div style={{marginTop: "10px"}}>
                        <img width="150" height="50" src={`${props.attributes.imgUrl}`}/>
                    </div>
                </FlexBlock>
                <FlexBlock>
                    <MediaUploadCheck>
                        <MediaUpload onSelect={onFileSelect2} value={props.attributes.imgID2} render={({open}) => {
                            return <Button variant="primary" onClick={open}>Spalvota nuotrauka</Button>
                        }} />
                    </MediaUploadCheck>
                    <div style={{marginTop: "10px"}}>
                        <img width="150" height="50" src={`${props.attributes.imgUrl2}`}/>
                    </div>
                </FlexBlock>
            </Flex>
            <Flex>
                <FlexBlock>
                    <TextControl label="Vardas ir pavardė" value={props.attributes.nameSurname} onChange={updateNameSurname}/>
                </FlexBlock>
                <FlexBlock>
                    <TextControl label="Pareigos" value={props.attributes.jobPosition} onChange={updateJobPosition}/>
                </FlexBlock>
            </Flex>
            <Flex>
                <FlexBlock>
                    <TextControl label="Telefonas" value={props.attributes.phoneNumber} onChange={updatePhoneNumber}/>
                </FlexBlock>
                <FlexBlock>
                    <TextControl label="El. paštas" value={props.attributes.emailAddress} onChange={updateEmailAddress} />
                </FlexBlock>
            </Flex>
        </div>
    )
}