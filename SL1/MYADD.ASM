
.model small

.data

a db 3
b db 5
sum db ?

.code
mov ax,@data
mov ds,ax

mov ah,a
mov bh,b

Add ah,bh
mov sum,ah

end