import random
import math
import copy
import matplotlib.pyplot as plt

prenoms=[['Morgane',[]],
        ['Joachim',[]],
        ['Nassim',[]],
        ['Elea',[]],
        ['Pauline',[]]]

days={'day1':'','day2':''}

Liste_finale={
		'Morgane':days.copy(),
        'Joachim':days.copy(),
        'Nassim':days.copy(),
        'Elea':days.copy(),
        'Pauline':days.copy()
	}

#Liste_finale=prenoms
jour1 = [['Dejeuner 1', 'Dejeuner 1','vaiselle M1'],['Diner 1', 'Diner 1','vaiselle S1']]

jour2 = [[ 'Dejeuner 2', 'Dejeuner 2','vaiselle M2'],['Salle de bain'],[ 'Diner 2', 'Diner 2','vaiselle S2']]

jours = [jour1,jour2]

task_max=0
for jour in jours:
    for sub_jour in jour:
        task_max+=len(sub_jour)

task_max = math.ceil(task_max/len(prenoms))

for num_jour,jour in enumerate(jours):
    task_jour=0
    for sub_jour in jour:
        task_jour += len(sub_jour)
        #print(task_jour)
        max_task_jour = math.ceil(task_jour/len(prenoms))
        
        while (len(sub_jour) > 0): #if max_task_jour>num_prenoms

            random.shuffle(prenoms)

            for prenom in prenoms:
                if len(sub_jour)>0: #if max_task_jour<num_prenoms
                    task = random.choice(sub_jour)
                else:
                    break
                #if len(prenom[1])<=max_task_jour:
                if not task in prenom[1]: #if person has less that the num_task_max and has not already the task to do
                    if len(prenom[1])<task_max : 
                        prenom[1].append(task)
                        jours_dico = Liste_finale[prenom[0]]
                        jours_dico['day'+str(num_jour+1)]+=task+str(' ')
                        Liste_finale[prenom[0]]=jours_dico
                        sub_jour.remove(task)

print('-------------------------------------------------------')
print(Liste_finale)
print('-------------------------------------------------------')
print(Liste_finale.values())
L=[]
for key,item in Liste_finale.items():
    L+=list(item.values())
print(L)
# Make data: I have 3 groups and 7 subgroups
group_names=list(Liste_finale.keys()) #prenom
group_size=[20]*len(group_names)
subgroup_names=L
subgroup_size=[10]*len(subgroup_names)
 
# Create colors
r, b=[plt.cm.Reds, plt.cm.Greens]

 
# First Ring (Inside)


for i in range (5):
    fig, ax = plt.subplots(figsize=(11,11))
    fig.subplots_adjust(bottom=0, top=1, left=0.2, right=0.7)
    mypie, _ = ax.pie(group_size, radius=1.2, labels=group_names, labeldistance=0.35,colors=['yellow', 'blue', 'orange', 'brown', 'purple'] )
    plt.setp(mypie, width=1.1, edgecolor='white')
    
    # Second Ring (outside)  
    mypie2, _ = ax.pie(subgroup_size, radius=2, labeldistance=0.45,labels=subgroup_names, colors=[r(0.5), b(0.5)]*5, rotatelabels =True, textprops = dict(rotation_mode = 'anchor', va='center') )
    plt.setp( mypie2, width=1.2, edgecolor='white')
    plt.margins(0,0)
    
    # show it
    fig.savefig('{}.png'.format(i), dpi=100)
    #group_names= group_names.insert(0,group_names.pop())
    
    group_names = [group_names[-1]] + group_names[:-1]
    print(group_names)
    plt.clf()
    plt.cla()

