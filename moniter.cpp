#include<iostream>
#include<cmath>
#include<cstdlib>
using namespace std;
void give_initial_input(){
	cout<<"1 0 0 1 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 2 0 0";
	//first player id then matrix
}
int mat[5][5];
int p_id;
int x,y,tx,ty;
int ox,oy;

void get_pos(int t=p_id){
	for(int i=0;i<5;i++){
		for (int j=0;j<5;j++){
			if(mat[i][j]==t){
				ox=i;oy=j;
			}
		}
	}
}

int check_move(){
	get_pos();
	if(x<5&&x>=0&&y<5&&y>=0&&tx<5&&tx>=0&&ty<5&&ty>=0){//in range
	
		if(abs(ox-x)<=1&&abs(oy-y)<=1){
			if(mat[x][y]==0&&mat[tx][ty]==0){//moved on blank
				if((x==tx&&y==ty)||(ox==x&&oy==y)){
					return 0;
				}
				return 1;
			}else if(mat[x][y]==0&&(tx==ox&&ty==oy)){
				if((x==tx&&y==ty)||(ox==x&&oy==y)){
					return 0;
				}
				return 1;
			}
		}else {
			
		
		}
	}
	return 0;
}
int is_won(){
	mat[ox][oy]=0;
	mat[x][y]=p_id;
	mat[tx][ty]=-1;
	int oppo=p_id%2+1;
	get_pos(oppo);
	int flag=1;
	for(int i=ox-1;i<=ox+1;i++){
		if(i<0||i>4) continue;
		for(int j=oy-1;j<=oy+1;j++){
				if(j<0||j>4) continue;
			if(mat[i][j]==0){
				flag=0;
			}
		}
	}
	return flag;
}
main(){
//	freopen("input.txt","r",stdin);//redirects standard input

	cin>>p_id;
	if(p_id==-256){
		give_initial_input();
	}else{
		for(int i=0;i<5;i++){
			for(int j=0;j<5;j++){
				cin>>mat[i][j];
			}
		}
		
		cin>>x>>y>>tx>>ty;
		if(check_move()==1){
			if(is_won()){
				cout<<"-22222";
			}else{
				  cout<<p_id%2+1<<" ";	
				  for(int i=0;i<5;i++){
				  	for(int j=0;j<5;j++){
				  		cout<<mat[i][j]<<" ";
					  }
				  }
				
			}
		}else{
			cout<<"-11111";
		}
	}
	
}