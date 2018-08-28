
# coding: utf-8

# In[6]:


get_ipython().run_line_magic('reload_ext', 'autoreload')
get_ipython().run_line_magic('autoreload', '2')
get_ipython().run_line_magic('matplotlib', 'inline')
from fastai.conv_learner import *
from fastai.plots import *
from planet import f2
from fastai.model import *
metrics=[f2]
f_model= resnet34


# In[7]:


Path = 'data/planet/'


# In[8]:


labels_csv=f'{Path}train_labels.csv'
n=len(list(open(labels_csv)))-1
val_idxs=get_cv_idxs(n,seed=42)


# In[9]:


def get_data(size):
    tfms=tfms_from_model(f_model,aug_tfms=transforms_top_down,max_zoom=1.1,sz=size)
    return ImageClassifierData.from_csv(Path,'train-jpg',label_csv,tfms=tfms,suffix='.jpg',val_idxs=val_idxs)


# In[10]:


data=get_data(256)


# In[11]:


learn=ConvLearner.pretrained(f_model,data,metrics=metrics,precompute=False)


# In[12]:


lrf=learn.lr_find()
learn.sched.plot()


# In[13]:


lr=0.5


# In[14]:


lrs=np.array([lr/9,lr/3,lr])


# In[15]:


learn.unfreeze()


# In[16]:


learn.fit(lrs,3,cycle_len=1,cycle_mult=2)


# In[19]:


sz=256
learn.save(f'{sz}')

