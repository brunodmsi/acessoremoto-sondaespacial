#Acesso Remoto - Sonda Espacial  
Este programa simula o acesso remoto à navegação de um robô espacial. O Robô que iremos
controlar foi idealizado apenas para mapear áreas planas em superfícies do planeta Marte para
facilitar pousos de futuros equipamentos terrestres.    
#Configurações  
A programação conta com um atributo para a memória de máquina intitulado platô
representado por uma matriz 10x20 de inteiros iniciados com valor 0 (zero). O robô pode se
movimentar livremente apenas nos sentidos NORTE, SUL, LESTE e OESTE.  
A posição inicial do robô é aleatória em relação ao platô.  
O controle de navegação será feito remoto por console, onde o controlador deve inserir códigos
de controle e verificar as possíveis respostas do robô.  
#Funcionamento geral  
Os códigos de controle são:  
<abre_colchete>ORIENTAÇÃO<espaço em branco>TOTAL_MOV<fecha_colchete>  
Onde,  
ORIENTAÇÃO → é um dígito N, S, L ou O (norte, sul, leste ou oeste).  
TOTAL_MOV → é o total de espaço que devem ser caminhados dentro do platô.  
Retorno:  
Como retorno o robô envia para o display SUCCESS ou FAILED para resultados  
positivos e negativos respectivamente.  
Comando especial para exibir no display o platô no formato linha x coluna.  
<abre_colchete><zero><espaço em branco><zero><fecha_colchete>  
#Memorização  
A principal tarefa do robô é memorizar áreas planas em sua memória representada pelo platô.  
A memorização é codificada por:  
0 → para áreas não visitadas  
1 → para áreas planas  
# → para áreas não planas (áreas de obstáculo).  
x → para a posição atual do robô  
  
Exemplo de uma navegação ocorrendo em tempo real, supondo posição inicial 1x1  
INPUTS OUTPUTS  
[L 2] SUCCESS  
[S 4] SUCCESS  
  
[0 0]  
00000000000000000000  
01100000000000000000  
00100000000000000000  
00100000000000000000  
00x00000000000000000  
00000000000000000000  
00000000000000000000  
00000000000000000000  
00000000000000000000  
00000000000000000000  
  
[L 3] SUCCESS  
[N 5] FAILED  
  
[0 0]  
00000000000000000000  
01100#00000000000000  
00100x00000000000000  
00100100000000000000  
00111100000000000000  
00000000000000000000  
00000000000000000000   
00000000000000000000  
00000000000000000000  
00000000000000000000  
  
No Exemplo acima, ao tentar mover 5 casas para o norte o robô encontrou um obstáculo no
terceiro movimento e por isso mapeou a área com # e parou um movimento antes do
obstáculo.  
OBS:. para realização de testes você deve gerar o total de 50 áreas aleatórias de
obstáculos com o cuidado de não repetir nenhuma área já ocupada incluindo a posição
inicial do robô.  
  
IMPEDIMENTO:. Linguagens C, Java, Python, C++.
