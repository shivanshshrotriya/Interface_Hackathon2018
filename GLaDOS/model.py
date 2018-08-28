from fastai.conv_learner import *
from fastai.plots import *
from planet import f2
from fastai.model import *
import PIL
import random
metrics=[f2]
f_model= resnet34

def predicting():
	Path='/home/aman/Downloads/fastai-master/courses/dl1/data/planet/'
	labels_csv='/home/aman/Downloads/fastai-master/courses/dl1/data/planet/train_labels.csv'
	n=len(list(open(labels_csv)))-1
	val_idxs=get_cv_idxs(n,seed=42)
	fin_list=''
	dict_out={}
	def get_data(size):
		tfms=tfms_from_model(f_model,aug_tfms=transforms_top_down,max_zoom=1.1,sz=size)    	
		return ImageClassifierData.from_csv(Path,'trainjpg',labels_csv,tfms=tfms,suffix='.jpg',val_idxs=val_idxs)
	data=get_data(256)
	filename=str(random.randint(1,4))+'.jpg'
	learn = ConvLearner.pretrained(f_model, data, metrics=metrics,precompute=False)
	learn.load('256')
	im=PIL.Image.open(filename).resize((256,256))
	pix=np.array(im)
	trn_tfms,val_tfms=tfms_from_model(f_model,256)
	im=trn_tfms(pix)
	preds=learn.predict_array(im[None])
	classes=data.classes
	for i in range(0,len(preds[0])):
		if int(preds[0][i])==1:
			fin_list += classes[i]
			fin_list += ' '
	dict_out['file']=filename
	dict_out['tags']=fin_list
	return dict_out
    	
#print(predicting())
